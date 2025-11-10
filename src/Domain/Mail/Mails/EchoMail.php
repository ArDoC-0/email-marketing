<?php

namespace Domain\Mail\Mails;

use Domain\Mail\Models\Broadcast\Broadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EchoMail extends Mailable implements ShouldQueue
{
    use ShouldQueue, SerializesModels;

    public function __construct(
        public readonly Broadcast $broadcast
    )
    {
    }

    public function build()
    {
        return $this->subject($this->broadcast->subject)
        ->view('emails.echo');
    }
}