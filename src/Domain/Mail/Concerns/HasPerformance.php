<?php

namespace Domain\Mail\Concerns;

use Domain\Mail\Actions\GetPerformanceAction;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPerformance
{
    public function performance()
    {
        return new Attribute(
            get: fn() => GetPerformanceAction::execute($this)
        );
    }
}