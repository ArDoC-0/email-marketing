<?php

namespace Database\Factories\Subscriber;

use App\Models\User;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubscriberFactory extends Factory
{
    protected $model = Subscriber::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->safeEmail(),
            'first_name'=> fake()->firstName(),
            'last_name'=> fake()->lastName(),
            'form_id' => Arr::random(Form::all(['id'])->toArray())['id'],
            'user_id' => Arr::random(User::all(['id'])->toArray())['id']
        ];
    }
}
