<?php

namespace Domain\Mail\Jobs\Sequence;

use Domain\Mail\Actions\Sequence\ProcessSequenceAction;
use Domain\Mail\Models\Sequence\Sequence;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\SerializesModels;

class ProcessSequenceJob implements ShouldQueue
{
    use Dispatchable, SerializesModels, Queueable, InteractsWithQueue;

    public function __construct(
        public readonly Sequence $sequence
    )
    {
        
    }
    public function handle()
    {
        ProcessSequenceAction::execute($this->sequence);
    }
}