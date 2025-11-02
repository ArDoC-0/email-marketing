<?php
namespace Domain\Subscriber\Actions;

use App\Models\User;
use Domain\Subscriber\DataTransferObjects\SubscriberDto;
use Domain\Subscriber\Models\Subscriber;

class UpertSubscriberAction
{

    public static function execute(SubscriberDto $data, User $user)
    {
        $subscriber = Subscriber::updateOrCreate(
            [
                'id'=> $data->id
            ],
            [
                ...$data->all(),
                'form_id' => $data->form?->id,
                'user_id' => $user->id
            ]);

        $subscriber->tags()->sync($data->tags->pluck('id'));

        return $subscriber->load('form', 'tags');
    }
}