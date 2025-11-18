<?php

namespace Domain\Subscriber\Builders;

use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Shared\Filters\DateFilters;
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

    public function whereSubscribedBetween(DateFilters $date)
    {
        return $this->whereBetween('subscribed_at', $date->toArray());
    }
}