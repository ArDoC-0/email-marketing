<?php

namespace Domain\Mail\Actions\Sequence;

use Domain\Mail\Mails\EchoMail;
use Domain\Mail\Models\SentMail;
use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Subscriber\Actions\FilterSubscribersAction;
use Domain\Subscriber\Enums\SubscriberStatus;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class ProcessSequenceAction
{
    protected static array $mailsBySubscribers = [];

    public static function execute(Sequence $sequence)
    {

        foreach ($sequence->sequence_mails()->wherePublished()->get() as $mail) {
            [$audience, $schedulableAudience] = self::audience($mail);

            self::sendMails($schedulableAudience, $mail, $sequence);

            self::addMailsToAudience($audience, $mail);

            self::markAsInprogress($sequence, $schedulableAudience);

        }
        
        self::markAsComplete($sequence);
    }

    public static function audience(SequenceMail $mail)
    {
        $audience = $mail->audience();

        if (!$mail->shouldSendToday()) {
            return [$audience, collect([])];
        }

        $schedulableAudience = $audience
            ->reject->alreadyReceivedMail($mail)
            ->reject->tooEarlyFor($mail);

        return [$audience, $schedulableAudience];
    }

    public function sendMails(
        Collection $schedulableAudience,
        SequenceMail $mail,
        Sequence $sequence
    ) : void 
    {

        foreach ($schedulableAudience as $subscriber) {
            Mail::to($subscriber)->queue(new EchoMail($mail));

            $mail->sent_mails()->create([
                'subscriber_id' => $subscriber->id,
                'user_id' => $sequence->user->id
            ]);
        }
    }

    /**
     * produce an array [['subscriber_id'] => [mail_id, mail_id]] used later 
     * to determine if the subscriber completed the whole sequence
     * cause each sequence mail in a sequence has its own audience based on filters,
     * so some of the subscribers won't receive the same set of mails
     */
    public function addMailsToAudience(
        Collection $audience,
        SequenceMail $mail
    ) : void
    {
        foreach($audience as $subscriber)
        {
            if(!Arr::get(self::$mailsBySubscribers, $subscriber->id))
            {
                self::$mailsBySubscribers [$subscriber->id] = [];
            }

            self::$mailsBySubscribers[$subscriber->id][] = $mail->id;
        }
    }

    public static function markAsInprogress(
        Sequence $sequence,
        Collection $schedulableAudience
    ) : void
    {
        $sequence->subscribers()
        ->whereIn('subscriber_id', $schedulableAudience->pluck('id'))
        ->update([
            'status' => SubscriberStatus::InProgress
        ]);
    }

    public static function markAsComplete(Sequence $sequence)
    {
        $subscribers = Subscriber::withCount([
            'received_mails' => fn (Builder $receivedMails) => 
            $receivedMails->whereSequence($sequence)

        ])->find(array_keys(self::$mailsBySubscribers))
        ->mapwithKeys(fn(Subscriber $subscriber) => [
            $subscriber->id => $subscriber
        ]);

        $completedSubscruberIds = [];

        foreach(self::$mailsBySubscribers as $subscriber_id => $mail_ids)
        {
            $subscriber = $subscribers[$subscriber_id];

            if($subscriber->received_mail_count === count($mail_ids))
            {
                $completedSubscruberIds[] = $subscriber->id;
            }
        }

        Subscriber::query()
        ->whereBelongsTo($sequence)
        ->whereIn('id', $completedSubscruberIds)
        ->update([
            'status' => SubscriberStatus::Completed
        ]);
    }
}
