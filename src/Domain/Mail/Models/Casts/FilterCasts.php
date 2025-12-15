<?php

namespace Domain\Mail\Models\Casts;

use Domain\Mail\DataTransferObjects\FilterData;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class FilterCasts implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        $filter_array = json_decode($value, true);
        return $filter_array ? 
        FilterData::from($filter_array) : 
        FilterData::empty();
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return [
            'filters' => json_encode($value)
        ];
    }
}