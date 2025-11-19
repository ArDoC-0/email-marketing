<?php

namespace Domain\Automation\DataTransferObjects;

use Spatie\LaravelData\Data;

class AutomationStepData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly int $value
    )
    {
        
    }
}