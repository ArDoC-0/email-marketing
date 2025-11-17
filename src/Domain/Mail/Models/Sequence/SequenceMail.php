<?php

namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Contracts\Sendable;
use Domain\Mail\DataTransferObjects\FilterData;
use Domain\Mail\Models\SentMail;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class SequenceMail extends BaseModel implements Sendable
{
    protected $table = "sequence_mails";

    protected $casts = [
        'filters' => FilterData::class
    ];

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

    public function enoughTimePassedSince(SentMail $mail) : bool
    {
        return $this->schedule
        ->unit
        ->timePassedSince($mail->sent_at) >= $this->schedule->delay;
    }

    public function sent_mails() : HasMany
    {
        return $this->hasMany(SentMail::class);
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
        return $this->id();
    }

    public function subject(): string
    {
        return $this->subject;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function type() : string
    {
        return $this::class;
    }

    public function filters(): FilterData
    {
        return $this->filters;
    }

}