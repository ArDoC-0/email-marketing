<?php

namespace Database\Factories\Mail;

use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Shared\Models\User;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BroadcastFactory extends Factory
{
    protected $model = Broadcast::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => fake()->sentence(4),
            'content'=> fake()->randomHtml(),
            'filters' => [
                'form_ids' => Arr::random(Form::all(['id'])->toArray(), 3),
                'tag_ids' => Arr::random(Tag::all(['id'])->toArray(), 5)
            ],
            'user_id' => Arr::random(User::all(['id'])->toArray())['id']
        ];
    }
}
