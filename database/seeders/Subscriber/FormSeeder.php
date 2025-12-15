<?php

namespace Database\Seeders\Subscriber;

use Domain\Subscriber\Models\Form;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Form::factory(20)->create();
    }
}
