<?php

namespace App\Mail;

use App\Models\AuditSubmission;
use Illuminate\Mail\Mailable;

class AuditSubmissionReceived extends Mailable
{
    public function __construct(public AuditSubmission $audit)
    {
        //
    }

    public function build(): static
    {
        return $this
            ->subject('Nuovo RADAR strategico - '.($this->audit->brand_name ?: $this->audit->company))
            ->view('emails.audit-submission-received');
    }
}
