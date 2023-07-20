<?php

namespace App\Repository;
use App\Models\Email;
use App\Models\User;
use Auth;
use App\Interfaces\EmailInterface;
use  App\Jobs\SendEmailJob;

class EmailRepository implements EmailInterface
{
    public function getInbox()
    {
        try {

            $user_id = Auth::user()->id;
            return Email::where('reciever_id',$user_id)->get();
          
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
        
    }
    public function getSendBox()
    {
        try {
            $user_id = Auth::user()->id;
            return Email::where('sender_id',$user_id)->get();
        } catch(\Exception $e){
            return $e->getMessage();
        }
        
    }
    public function sendEmail($emailRequest)
    {
        try {
            $user = Auth::user();
            $userEmail= User::where('email', $emailRequest->mail_to)->first();
            $email=new Email();
            $email->sender_id=$user->id;
            $email->reciever_id=$userEmail->id;
            $email->subject=$emailRequest->subject;
            $email->body=$emailRequest->body;
            $email->save();
            $data['from_email'] = $user->email;
            $data['email'] = $userEmail->email;
            $data['name'] = $userEmail->name;
            $data['subject'] = $emailRequest->subject;
            $data['body'] = $emailRequest->body;
            dispatch(new SendEmailJob($data));
        } catch(\Exception $e){
            return $e->getMessage();
        }
        
    }

    
}