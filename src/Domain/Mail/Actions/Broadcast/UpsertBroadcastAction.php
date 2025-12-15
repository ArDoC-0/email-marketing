<?php

namespace Domain\Mail\Actions\Broadcast;

use Domain\Mail\DataTransferObjects\Broadcast\BroadcastData;
use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Shared\Models\User;

class UpsertBroadcastAction
{

    public static function execute(BroadcastData $broadcastData, User $user)
    {
        return Broadcast::updateOrCreate(
            [
                $broadcastData->id
            ],
            [
                ...$broadcastData->all(),
                'user_id'=> $user->id
            ]
            );
    }
}