<?php
namespace Domain\Shared\CommonDto;

use Illuminate\Database\Eloquent\Collection;
use Reflection;
use ReflectionClass;

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

    public function all()
    {
        $reflection = new ReflectionClass(static::class);
        $properties = $reflection->getProperties();

        $values = [];
        foreach($properties as $key){

            $key->setAccessible(true);
            $values = [
                ...$values,
                $key->getName() => $key->getValue($this)
            ];
        };
        return $values;
    }
}