<?php

namespace Domain\Mail\Models\Broadcast;

use Domain\Mail\Builder\Broadcast\BroadcastBuilder;
use Domain\Mail\Contracts\Sendable;
use Domain\Mail\DataTransferObjects\Broadcast\BroadcastData;
use Domain\Mail\Enums\Broadcast\BroadcastStatus;
use Domain\Mail\Models\Casts\FilterCasts;
use Domain\Mail\Models\SentMail;
use Domain\Shared\Concerns\HasUser;
use Domain\Shared\Models\BaseModel;

class Broadcast extends BaseModel implements Sendable
{
    use HasUser;
    protected $dataClass = BroadcastData::class;

    protected $casts = [
        'filters' => FilterCasts::class,
        'status' => BroadcastStatus::class
    ];

    protected $fillable = [
        'subject',
        'content',
        'filters',
        'status'
    ];

    public function id() : int
    {
        return $this->id();
    }

    public function type() : string
    {
        return $this::class;
    }

    public function newEloquentBuilder($query) : BroadcastBuilder
    {
        return new BroadcastBuilder($query);
    }

    public function sent_mails()
    {
        return $this->morphMany(SentMail::class, 'sendable');
    }
}