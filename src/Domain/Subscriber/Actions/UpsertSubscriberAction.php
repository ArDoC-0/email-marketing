<?php
namespace Domain\Subscriber\Actions;

use Domain\Automation\Events\SubscribedToFormEvent;
use Domain\Shared\Models\User;
use Domain\Subscriber\DataTransferObjects\SubscriberDto;
use Domain\Subscriber\Models\Subscriber;

class UpsertSubscriberAction
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

        $data->whenSubscriberdedViaForm(
            event(new SubscribedToFormEvent($subscriber, $user))
        );

        return $subscriber->load('form', 'tags');
    }
}