<?php

namespace Database\Factories\Subscriber;

use Domain\Subscriber\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Generator\PeclUuidRandomGenerator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FormFactory extends Factory
{
    protected $model = Form::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(rand(1, 3)),
            'content' => fake()->sentence(20)
        ];
    }
}
