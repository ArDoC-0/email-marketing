<?php

namespace App\Console\Commands\Subscriber;

use Domain\Shared\Models\User;
use Domain\Subscriber\Jobs\ImportSubscriberJob;
use Illuminate\Console\Command;

class ImportSubscribersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriber:import {user? : The ID of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import subscribers from csv';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user_id = $this->argument('user') ?? $this->ask('User ID');

        ImportSubscriberJob::dispatch(
            storage_path('subscriber/Subscribers.csv'),
            User::findOrFail($user_id)
        );

        $this->info('Subscribers are being imported....');

        return self::SUCCESS;
    }
}
