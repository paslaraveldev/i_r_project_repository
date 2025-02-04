<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class SupervisorCommentsNotification extends Notification
{
   use Queueable;

    protected $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Supervisor Comments on Your Project Report')
            ->line('Your supervisor has provided comments on your project report.')
            ->line('Status: ' . $this->report->status)
            ->action('View Comments', url('/project-reports/' . $this->report->id))
            ->line('Thank you for your hard work!');
    }

    public function toArray($notifiable)
    {
        return [
            'report_id' => $this->report->id,
            'title' => $this->report->title,
            'status' => $this->report->status,
            'comments' => $this->report->supervisor_comments,
        ];
    }
}
