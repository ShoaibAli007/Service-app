<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Email\EmailRequest;
use App\Interfaces\EmailInterface;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $emailInterface;
    public function __construct(EmailInterface $emailInterface) {
        $this->emailInterface = $emailInterface;
    }

    public function emailCreate()
    {
        return view('admin.emails.create');

    }

    public function getInbox()
    {
        $emails =  $this->emailInterface->getInbox();
        $title = "Inbox";
        return view('admin.emails.listing',compact('emails','title'))
            ->with('i',0);
    }

    public function getSendBox()
    {
        $title = "Send Box";
        $emails =  $this->emailInterface->getSendBox();
        return view('admin.emails.listing',compact('emails','title'))
                ->with('i',0);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function sendEmail(EmailRequest $emailRequest)
    {
        $this->emailInterface->sendEmail($emailRequest);
        return redirect()->route('email.inbox')
                        ->with('success','Email send successfully.');
    }
}
