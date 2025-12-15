<?php

namespace Domain\Mail\DataTransferObjects\Sequence;

use Spatie\LaravelData\Data;

class ScheduleData extends Data
{
    public function __construct(
        public readonly ?int  $id,
        public readonly int  $delay,
        public readonly SequenceMailAllowedDaysData $allowedDays 
    )
    {
        
    }

}