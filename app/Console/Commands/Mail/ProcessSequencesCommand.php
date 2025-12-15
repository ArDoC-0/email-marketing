<?php

namespace App\Console\Commands\Mail;

use Domain\Mail\Enums\Sequence\SequenceStatus;
use Domain\Mail\Jobs\Sequence\ProcessSequenceJob;
use Domain\Mail\Models\Sequence\Sequence;
use Illuminate\Console\Command;

class ProcessSequencesCommand extends Command
{
    protected $signature = 'sequence:proceed';

    protected $description = 'Send the next mail in a sequence';

    public function handle() : int
    {
        $count = Sequence::with('sequence_mails.schedule')
        ->whereStatus(SequenceStatus::Published)->get()
        ->each(function (Sequence $sequence) {
            ProcessSequenceJob::dispatch($sequence);
        })
        ->count();

        $this->info("{$count} sequences have been proceeded");

        return self::SUCCESS;
    }
}