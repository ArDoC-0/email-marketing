<?php

namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Models\Casts\Sequence\SequenceMailScheduleAllowedDaysCast;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SequenceMailSchedule extends BaseModel
{
    protected $table = 'sequence_mail_allowed_days';

    protected $fillable = [
        'sequence_mail_id',
        'allowed_days',
        'unit',
        'delay'
    ];

    protected $casts = [
        'allowed_days' => SequenceMailScheduleAllowedDaysCast::class
    ];

    public function sequenceMail(): BelongsTo
    {
        return $this->belongsTo(SequenceMail::class);
    }

}
