<?php

namespace Domain\Shared\ViewModels;

use Illuminate\Contracts\Support\Arrayable;
use Reflection;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Support\Str;


abstract class ViewModel implements Arrayable
{

    public function toArray()
    {

        $attributes = collect((new ReflectionClass($this))->getMethods())
            ->reject(
                fn(ReflectionMethod $method) => in_array($method->getName(), ['__construct', 'toArray'])
            )
            ->filter(
                fn(ReflectionMethod $method) => in_array('public', Reflection::getModifierNames($method->getModifiers()))
            )
        ->mapWithKeys(fn (ReflectionMethod $method) => [
            Str::snake($method->getName()) => $this->{$method->getName()}()
        ])
        ->toArray();

        return $attributes;
    }
}
