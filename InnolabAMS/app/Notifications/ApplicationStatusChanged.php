<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Application;


class ApplicationStatusChanged extends Notification
{
    use Queueable;

    protected $application;
    protected $oldStatus;
    protected $newStatus;

    public function __construct(Application $application, $oldStatus, $newStatus)
    {
        $this->application = $application;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Application Status Updated')
            ->line("Your application status has been updated.")
            ->line("Previous status: {$this->oldStatus}")
            ->line("New status: {$this->newStatus}")
            ->line("Remarks: {$this->application->remarks}")
            ->action('View Application', url("/applications/{$this->application->id}"));
    }

    public function toDatabase($notifiable)
    {
        return [
            'application_id' => $this->application->id,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'message' => "Application status changed from {$this->oldStatus} to {$this->newStatus}"
        ];
    }
}
