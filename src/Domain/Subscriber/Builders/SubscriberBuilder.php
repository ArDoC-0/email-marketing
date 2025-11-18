<?php

namespace Domain\Subscriber\Builders;

use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\Models\Sequence\SequenceMail;
use Illuminate\Database\Eloquent\Builder;

class SubscriberBuilder extends Builder
{
    public function alreadyReceived(SequenceMail $mail) : bool
    {
        return $this->received_mails()->whereSendable($mail)->exists();
    }

    public function whereSequence(Sequence $sequence)
    {
        return $this->whereBelongsTo($sequence);
    }
}