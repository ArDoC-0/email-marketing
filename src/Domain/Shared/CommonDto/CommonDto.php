<?php
namespace Domain\Shared\CommonDto;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Reflection;
use ReflectionClass;
use ReflectionParameter;

abstract class CommonDto
{

    public static function fromArray(array $data)
    {
        $__construct_parameters = collect((new ReflectionClass(static::class))
        ->getConstructor()
        ->getParameters())
        ->map(fn(ReflectionParameter $param) => $param->getName())
        ->toArray();

        $expected_parameters_and_values = collect($data)->filter(fn ($param, $key) => in_array($key, $__construct_parameters))->all();

        return new static(
            ...$expected_parameters_and_values
        );
    }

    public static function collection(Collection $data)
    {
        $collection = $data->map(function(Model $d){
            return static::fromArray(
                $d->toArray()
            );
        });

        return $collection;
    }

    public function all()
    {
        $reflection = new ReflectionClass($this);
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