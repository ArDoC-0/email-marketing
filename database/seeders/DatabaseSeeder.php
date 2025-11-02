<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Subscriber\FormSeeder;
use Database\Seeders\Subscriber\SubscriberSeeder;
use Database\Seeders\Subscriber\TagSeeder;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Tag;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call(FormSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(SubscriberSeeder::class);
    }
}
