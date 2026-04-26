<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $msgRecord;
    public $replyText;

    public function __construct(Message $msgRecord, string $replyText)
    {
        $this->msgRecord = $msgRecord;
        $this->replyText = $replyText;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Re: ' . $this->msgRecord->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.messages.reply',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
