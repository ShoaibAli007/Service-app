<?php
namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendEmail;
use Mail;
class SendEmailJob implements ShouldQueue
{
use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
protected $data;
/**
* Create a new job instance.
*
* @return void
*/
public function __construct($data)
{
$this->data = $data;
}
/**
* Execute the job.
*
* @return void
*/
public function handle()
{
    $email = new SendEmail($this->data);
    Mail::to($this->data['email'])
    ->send($email);
}
}