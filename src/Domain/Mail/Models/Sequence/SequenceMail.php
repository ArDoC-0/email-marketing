<?php

namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Contracts\Sendable;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class SequenceMail extends BaseModel implements Sendable
{
    protected $table = "sequence_mails";

    protected $fillable = [
        'subject',
        'content',
        'filters',
        'sequence_id'
    ];

    public function shouldSendToday() : bool
    {
        $today = Str::lower(now()->dayName);

        return $this->schedule->allowed_days->{$today};
    }

    public function sequence(): BelongsTo
    {
        return $this->belongsTo(Sequence::class);
    }

    public function schedule(): HasOne
    {
        return $this->hasOne(SequenceMailSchedule::class);
    }

    public function id() : int
    {
        return $this->id;
    }

    public function type() : string
    {
        return $this::class;
    }
}