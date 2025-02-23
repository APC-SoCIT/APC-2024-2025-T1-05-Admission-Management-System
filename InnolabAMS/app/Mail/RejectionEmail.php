<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ApplicantInfo;

class RejectionEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;

    public function __construct(ApplicantInfo $applicant)
    {
        $this->applicant = $applicant;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Application Accepted')
            ->view('email.rejected')
            ->with(['applicant' => $this->applicant]);
    }
}

