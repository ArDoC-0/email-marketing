<?php

namespace Database\Seeders\Mail;

use Domain\Mail\Models\Broadcast\Broadcast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BroadcastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         Broadcast::factory(20)->create();
    }
}