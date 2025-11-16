<?php

namespace Domain\Mail\DataTransferObjects\Sequence;

use Domain\Mail\Enums\Sequence\SequenceMailStatus;
use Domain\Mail\Enums\Sequence\SequenceStatus;
use Spatie\LaravelData\Data;

class SequenceData extends Data
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?SequenceStatus $status
    )
    {
        
    }
}