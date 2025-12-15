<?php

namespace Domain\Mail\Builder\Sequence;

use Domain\Subscriber\Enums\SubscriberStatus;
use Illuminate\Database\Eloquent\Builder;

class SequenceBuilder extends Builder
{
    
    public function whereStatus($status)
    {
        return $this->whereIn('status', [...$status]);
    }

    public function activeSubscribercount() : int
    {
        return $this->subscribers()
        ->whereNotNull('status')
        ->count();
    }

    public function inProgressSubscriberCount()
    {
        return $this->subscribers()
        ->whereStatus(SubscriberStatus::InProgress)
        ->count();
    }

    public function completedSubscriberCount()
    {
        return $this->subscribers()
        ->whereStatus(SubscriberStatus::Completed)
        ->count();
    }
}