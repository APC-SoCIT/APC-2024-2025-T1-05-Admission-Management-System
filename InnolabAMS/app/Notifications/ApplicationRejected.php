<?php

namespace App\Notifications;

use App\Models\ApplicantInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationRejected extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected ApplicantInfo $applicant
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Update on Your Application - InnolabAMS')
            ->greeting('Dear ' . $this->applicant->full_name)
            ->line('We regret to inform you that your application has been rejected.')
            ->line('Reason for rejection:')
            ->line($this->applicant->rejection_reason)
            ->line('If you have any questions, please don\'t hesitate to contact us.')
            ->salutation('Best regards,')
            ->salutation('InnolabAMS Admissions Team');
    }
}
