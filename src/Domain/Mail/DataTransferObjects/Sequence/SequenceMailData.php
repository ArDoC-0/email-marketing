<?php

namespace Domain\Mail\DataTransferObjects\Sequence;

use Domain\Mail\DataTransferObjects\FilterData;
use Domain\Mail\Enums\Sequence\SequenceMailStatus;
use Spatie\LaravelData\Data;

class SequenceMailData extends Data
{
    public function __construct(
        public readonly ?string $subject,
        public readonly ?string $content,
        public readonly SequenceMailStatus $status,
        public readonly FilterData $filters,
        public readonly array $schedule
    )
    {
        
    }

    public static function dummy()
    {
        return self::from([
            'subject' => "welcome to my awesome email",
            'content' => "welcome to my awesome email",
            'status' => SequenceMailStatus::Draft,
            'filters' => FilterData::empty(),
            'schedule'=> [
                'delay' =>1,
                'unit' => 'day',
                'aalowed_days' => SequenceMailAllowedDaysData::empty()
            ]
            
        ]);
    }
}