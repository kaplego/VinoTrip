<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $subject;

    public function __construct($mailData, $subject)
    {
        $this->mailData = $mailData;
        $this->subject = $subject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'mail',
            with: $this->mailData,
        );
    }

    public function attachments(): array
    {
        if (isset($this->mailData['attachment'])) {
            return [
                Attachment::fromPath($this->mailData['attachment']['path'])
                    ->as($this->mailData['attachment']['name'])
                    ->withMime('application/json')
            ];
        }

        return [];
    }
}
