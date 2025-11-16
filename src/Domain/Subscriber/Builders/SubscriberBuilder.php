<?php

namespace Domain\Subscriber\Builders;

use Domain\Mail\Models\Sequence\SequenceMail;
use Illuminate\Database\Eloquent\Builder;

class SubscriberBuilder extends Builder
{
    public function alreadyReceived(SequenceMail $mail) : bool
    {
        return $this->received_mails()->whereSendable($mail)->exists();
    }
}