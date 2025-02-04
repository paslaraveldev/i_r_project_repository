<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupervisorCommentNotification extends Mailable
{
   use Queueable, SerializesModels;

    public $report;
    public $comment;
    
    public function __construct($report, $comment)
    {
        $this->report = $report;
        $this->comment = $comment;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('New Supervisor Comment on Your Report')
                    ->view('emails.supervisor_comment_notification');
    }
}
