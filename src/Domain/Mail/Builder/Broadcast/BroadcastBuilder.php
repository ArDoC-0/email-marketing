<?php

namespace Domain\Mail\Builder\Broadcast;

use Domain\Mail\Enums\Broadcast\BroadcastStatus;
use Illuminate\Database\Eloquent\Builder;

class BroadcastBuilder extends Builder
{

    public function markAsSent()
    {
        $this->model->status = BroadcastStatus::Sent;
        $this->model->sent_at = now();
        $this->model->save();
        
    }
}