<?php

namespace Domain\Automation\Builders;

use Illuminate\Database\Eloquent\Builder;

class AutomationStepBuilder extends Builder
{
    public function whereName(string $name)
    {
        return $this->where('name', $name);
    }

    public function whereType(string $type)
    {
        return $this->where('type', $type);
    }

}