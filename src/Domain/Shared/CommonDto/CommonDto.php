<?php
namespace Domain\Shared\CommonDto;

use Illuminate\Database\Eloquent\Collection;

abstract class CommonDto
{

    protected static function fromArray(array $data)
    {
        return new static(
            ...$data
        );
    }

    protected static function collection(Collection $data)
    {
        $collection = $data->map(function($d){
            static::fromArray(
                $d->toArray()
            );
        });
        
        return $collection;
    }
}