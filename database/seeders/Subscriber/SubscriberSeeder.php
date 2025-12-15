<?php

namespace Database\Seeders\Subscriber;

use Domain\Shared\Models\User;
use Domain\Subscriber\Models\Subscriber;
use Domain\Subscriber\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscriber::factory(30)
        ->has(Tag::factory()->count(4))
        ->create();
    }
}
