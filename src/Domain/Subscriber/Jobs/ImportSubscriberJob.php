<?php

namespace Domain\Subscriber\Jobs;

use Domain\Shared\Models\User;
use Domain\Subscriber\Actions\ImportSubscriberAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportSubscriberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
         public readonly string $path, 
        private readonly User $user
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ImportSubscriberAction::execute($this->path, $this->user);
    }
}
