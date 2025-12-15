<?php

namespace Domain\Mail\Models\Casts\Sequence;

use Domain\Mail\DataTransferObjects\Sequence\SequenceMailAllowedDaysData;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class SequenceMailScheduleAllowedDaysCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return SequenceMailAllowedDaysData::from(
            json_decode($value, true)
        );
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return [
            'allowed_days' => json_encode($value)
        ];
    }
}