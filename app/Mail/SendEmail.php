<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class SendEmail extends Mailable
{
use Queueable, SerializesModels;
/**
* Create a new message instance.
*
* @return void
*/
protected $data;
public function __construct($data)
{
    $this->data=$data;
}
/**
* Build the message.
*
* @return $this
*/
public function build()
{
return  $this->from($this->data['from_email'])
->subject('Your Email Subject')->view('emails.sendEmail',['data'=>$this->data]);
}
}