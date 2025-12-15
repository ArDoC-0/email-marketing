<?php
namespace Domain\Shared\Concerns;

use Spatie\LaravelData\Exceptions\InvalidDataClass;

trait WithData
{
    public function getData()
    {
        $dataclass = match(true){
            property_exists($this, 'dataclass') => $this->dataClass,
            method_exists($this, 'dataclass') => $this->dataClass(),
            default => null
        };
        if(!$dataclass)
        {
            throw InvalidDataClass::create($dataclass);
        }

        return $dataclass::fromArray($this->toArray());
    }
}