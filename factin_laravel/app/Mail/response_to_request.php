<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class response_to_request extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Response to request";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $dates = $request->soldate;
        return $this->view('partials.Email.ResponseToRequest',compact('dates'));
    }
}
