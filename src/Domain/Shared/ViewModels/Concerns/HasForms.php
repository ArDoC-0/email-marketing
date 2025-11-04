<?php

namespace Domain\Shared\ViewModels\Concerns;

use Domain\Subscriber\DataTransferObjects\FormDto;
use Domain\Subscriber\Models\Form;

trait HasForms
{
    public function forms()
    {
        return Form::all()->map(fn(Form $from) => FormDto::fromArray($from->toArray()))->toArray();
    }
}
