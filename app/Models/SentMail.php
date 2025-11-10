<?php

namespace App\Models;

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

}
