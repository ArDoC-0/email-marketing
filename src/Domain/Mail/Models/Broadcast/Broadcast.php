<?php

namespace Domain\Mail\Models\Broadcast;

use Domain\Mail\DataTransferObjects\Broadcast\BroadcastData;
use Domain\Mail\Enums\Broadcast\BroadcastStatus;
use Domain\Mail\Models\Casts\FilterCasts;
use Domain\Shared\Models\BaseModel;

class Broadcast extends BaseModel
{

    protected $dataClass = BroadcastData::class;

    protected $casts = [
        'filters' => FilterCasts::class,
        'status' => BroadcastStatus::class
    ];

    protected $fillable = [
        'subject',
        'content',
        'filters'
    ];

}