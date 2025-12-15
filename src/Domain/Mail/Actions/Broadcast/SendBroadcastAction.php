<?php

namespace Domain\Mail\Actions\Broadcast;

use Domain\Mail\Exceptions\Broadcast\CannotSendBroadcast;
use Domain\Mail\Mails\EchoMail;
use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Subscriber\Actions\FilterSubscribersAction;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class SendBroadcastAction
{

    public static function execute(Broadcast $broadcast)
    {
        if(!$broadcast->status->canSend())
        {
            throw CannotSendBroadcast::broadcastAlreadySent($broadcast->sent_at);
        }

        $subscribers = $broadcast->audience()->each(
            function (Subscriber $subscriber) use ($broadcast){
                Mail::to($subscriber)->queue(new EchoMail($broadcast));
            }
        );
        
        $broadcast->markAsSent();

        return $subscribers->each(function (Subscriber $subscriber) use ($broadcast){
            $broadcast->sent_mails()->create([
                'subscriber_id' => $subscriber->id,
                'user_id' => $broadcast->user_id
            ]);
        })->count();
    }
}