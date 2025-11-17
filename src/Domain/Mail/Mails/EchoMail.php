<?php

namespace Domain\Mail\Mails;

use Domain\Mail\Contracts\Sendable;
use Domain\Mail\Models\Broadcast\Broadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EchoMail extends Mailable implements ShouldQueue
{
    use ShouldQueue, SerializesModels;

    public function __construct(
        public readonly Sendable $sendable
    )
    {
    }

    public function build()
    {
        return $this->subject($this->sendable->subject)
        ->view('emails.echo');
    }
}