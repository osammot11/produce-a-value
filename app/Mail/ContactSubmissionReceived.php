<?php

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Mail\Mailable;

class ContactSubmissionReceived extends Mailable
{
    public function __construct(public ContactSubmission $contact)
    {
        //
    }

    public function build(): static
    {
        return $this
            ->subject('Nuovo contatto generico - '.$this->contact->name)
            ->view('emails.contact-submission-received');
    }
}
