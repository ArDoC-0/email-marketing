<?php

namespace Domain\Automation\Jobs;

use Domain\Automation\Actions\RunAutomationsAction;
use Domain\Automation\Enums\Events;
use Domain\Shared\Models\User;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Testing\Fluent\Concerns\Interaction;

class RunAutomationsJob implements ShouldQueue
{
    use Dispatchable, SerializesModels, InteractsWithQueue;

    public function __construct(
        public readonly Subscriber $subscriber,
        public readonly User $user,
        public readonly Events $event
    )
    {
        
    }

    public function handle()
    {
        RunAutomationsAction::execute(
            $this->subscriber,
            $this->user,
            $this->event
        );
    }
}