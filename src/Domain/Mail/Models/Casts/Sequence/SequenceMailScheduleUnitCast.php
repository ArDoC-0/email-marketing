<?php

namespace Domain\Mail\Models\Casts\Sequence;

use Domain\Mail\Enums\Sequence\SequenceMailUnit;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class SequenceMailScheduleUnitCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return SequenceMailUnit::from($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        // return SequenceMailUnit::class;
        return $value;
    }
}