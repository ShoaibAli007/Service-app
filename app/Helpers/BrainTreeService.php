<?php 
namespace App\Helpers;
use Braintree\Gateway;

class BrainTreeService
{
    protected static function getGateway()
    {
        // Create a new instance of the Braintree Gateway manually
        return new Gateway(
          ['environment' => env('BRAINTREE_ENVIRONMENT'),
          'merchantId' => env("BRAINTREE_MERCHANT_ID"),
          'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
          'privateKey' => env("BRAINTREE_PRIVATE_KEY")]
        );
    }

    public static function createClientToken()
    {
        $gateway = self::getGateway();
        // dd($gateway);   
            return $gateway->clientToken()->generate();
    }

    public static function chargeService($data)
    {
        // dd($data);
        $gateway = self::getGateway();
        $gateway->transaction()->sale([
            'amount' => $data['amount'],
            'paymentMethodNonce' => $data['payment_method_nonce'],
            'options' => [
                'submitForSettlement' => True,   
            ],
        ]);
    }
}