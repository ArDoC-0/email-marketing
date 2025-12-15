<?php

namespace Domain\Automation\Actions\Steps;

use Domain\Automation\Models\AutomationStep;
use Domain\Subscriber\Models\Subscriber;

class AddTagAction
{
    public function __invoke(Subscriber $subscriber, AutomationStep $step)
    {
        $subscriber->tags()->attach($step->value['id']);
    }
}