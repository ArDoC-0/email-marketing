<?php

namespace Database\Factories\Subscriber;

use Domain\Shared\Models\User;
use Domain\Subscriber\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(rand(1, 3)),
            'user_id' => Arr::random(User::all(['id'])->toArray())['id']
        ];
    }
}
