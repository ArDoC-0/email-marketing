<?php

namespace Domain\Mail\Models;

use Domain\Mail\Builder\SentMails\SentMailBuilder;
use Illuminate\Database\Eloquent\Model;

class SentMail extends Model
{
    protected $fillable = [
        'sendable_type',
        'subscriber_id',
        'user_id',
        'opened_at',
        'clicked_at'
    ];

    public function sendable()
    {
        return $this->morphTo();
    }

    public function newEloquentBuilder($query)
    {
        return new SentMailBuilder($query);
    }
}
