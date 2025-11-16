<?php

namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Contracts\Sendable;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SequenceMail extends BaseModel implements Sendable
{
    protected $table = "sequence_mails";

    protected $fillable = [
        'subject',
        'content',
        'filters',
        'sequence_id'
    ];

    public function sequence(): BelongsTo
    {
        return $this->belongsTo(Sequence::class);
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