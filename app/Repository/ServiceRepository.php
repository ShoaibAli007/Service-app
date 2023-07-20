<?php

namespace App\Repository;

use App\Helpers\BrainTreeService;
use App\Helpers\StripeService as HelpersStripeService;
use App\Interfaces\ServiceInterface;
use App\Models\Service;
use App\Models\ServicePurchase;
use App\Helpers\StripeService;
use Auth;
use Braintree;
use  App\Jobs\SendEmailJob;

class ServiceRepository implements ServiceInterface
{
    public function index(){
        try{
            $data['services'] = Service::get();
            $data['token'] = BrainTreeService::createClientToken();
            return $data;
        } catch (\Exception $e)
        {
            return $e->getMessage();
        }   
    }

    public function getPurchaseService()
    {
        try{
            $user = Auth::user();
            return ServicePurchase::where('user_id',$user->id)->get();
        } catch (\Exception $e)
        {
            return $e->getMessage();
        }  
    }

    public function purchaseService($request)
    {
        
        try{
            $user = Auth::user();
            $serviceId = $request->service_id;
            $paymentMethodNonce = $request->payment_method_nonce;

            // Save service purchase record
            $this->saveServicePurchase($user->id, $serviceId);

            // Charge the service using BrainTree
            $service = Service::find($serviceId);
            $amount = $service->price;
            $this->chargeService($serviceId, $paymentMethodNonce, $amount);

            // Send a thank-you email using Laravel Job
            $this->sendThankYouEmail($user->email,$user->name,$service->name,$service->price);

            return;
            
        } catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }

    protected function saveServicePurchase($userId, $serviceId)
    {
        $servicePurchase = new ServicePurchase();
        $servicePurchase->user_id = $userId;
        $servicePurchase->service_id = $serviceId;
        $servicePurchase->status = 'requested';
        $servicePurchase->save();
    }

    protected function chargeService($serviceId, $paymentMethodNonce, $amount)
    {
        $data['service_id'] = $serviceId;
        $data['payment_method_nonce'] = $paymentMethodNonce;
        $data['amount'] = $amount;

        BrainTreeService::chargeService($data);
    }

    protected function sendThankYouEmail($email,$name,$serviceName,$price)
    {
        $data['name'] = $name;
        $data['from_email'] = env('MAIL_FROM_ADDRESS');
        $data['email'] = $email;
        $data['subject'] = "Thanks for the purchase";
        $data['body'] = "Thank you for your purchase of the service '{$serviceName}' at the price of {$price}$. We appreciate your business!";

        dispatch(new SendEmailJob($data));
    }


}