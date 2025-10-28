<?php

namespace Domain\Shared\ViewModels;

use Illuminate\Contracts\Support\Arrayable;
use Reflection;
use ReflectionClass;
use ReflectionMethod;

abstract class ViewModel implements Arrayable
{

    public function toArray()
    {
        $reflection = collect((new ReflectionClass($this))->getMethods())
        ->reject(function (ReflectionMethod $method){
            return in_array($method, ['__construct', 'toArray']);
        })
        ->filter(function (ReflectionMethod $method){
            return in_array('public', Reflection::getModifierNames($method->getModifiers()));
        })
        ->mapWithKeys(fn (ReflectionMethod $method)=> [
            Str::snake($method) => $this->{$method->getName()}()
        ])
        ->toArray();
        
    }
}