<?php

namespace App\Notifications;

use App\Models\ApplicantInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationAccepted extends Notification implements ShouldQueue
{
    use Queueable;

    protected $applicant;

    public function __construct(ApplicantInfo $applicant)
    {
        $this->applicant = $applicant;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Application Accepted - Welcome to Our School!')
            ->greeting('Dear ' . $this->applicant->full_name . ',')
            ->line('Congratulations! We are pleased to inform you that your application has been accepted.')
            ->line($this->applicant->acceptance_message)
            ->line('Next Steps:')
            ->line('1. Complete the enrollment process')
            ->line('2. Submit any remaining requirements')
            ->line('3. Attend the orientation session')
            ->action('View Application Details', route('admission.show', $this->applicant->id))
            ->line('Thank you for choosing our institution. We look forward to welcoming you!');
    }
}
