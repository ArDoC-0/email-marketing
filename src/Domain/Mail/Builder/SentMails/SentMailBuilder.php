<?php

namespace Domain\Mail\Builder\SentMails;

use Domain\Mail\Contracts\Sendable;
use Domain\Mail\Enums\Sequence\SequenceMailStatus;
use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Shared\ValueObject\Percent;
use Illuminate\Database\Eloquent\Builder;

class SentMailBuilder extends Builder
{

    public function wherePublished()
    {
        return $this->where('status', SequenceMailStatus::Published);
    }

    public function countOf(Sendable $sendable) : int
    {
        return $this->whereSendable($sendable)
        ->count();
    }

    public function whereSendable(Sendable $sendable)
    {
        return $this->where('sendable_id', $sendable->id())
                    ->where('sendable_type', $sendable->type());
    }

    public function openRate(Sendable $sendable, int $total)
    {
        $count = $this->whereSendable($sendable)
                    ->whereOpened()
                    ->count();

        return Percent::from($count, $total);
    }

    public function clickRate(Sendable $sendable, int $total)
    {
        $count = $this->whereSendable($sendable)
        ->whereClicked()
        ->count();

        return Percent::from($count, $total);
    }

    public function whereOpened()
    {
        return $this->whereNotNull('opened_at');
    }

    public function whereClicked()
    {
        return $this->whereNotNull('clicked_at');
    }
}