<?php

namespace Domain\Mail\Actions\Sequence;

use Domain\Mail\Mails\EchoMail;
use Domain\Mail\Models\SentMail;
use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Subscriber\Actions\FilterSubscribersAction;
use Illuminate\Support\Facades\Mail;

class ProcessSequenceAction
{
    public static function execute(Sequence $sequence)
    {
        $sent_mail_count = 0;
        
        foreach($sequence->sequence_mails()->wherePublished()->get() as $mail) 
        {
            $subscribers = self::subscribers($mail);

            foreach($subscribers as $subscriber)
            {
                Mail::to($subscriber)->queue(new EchoMail($mail));

                $mail->sent_mails()->create([
                    'subscriber_id' => $subscriber->id,
                    'user_id' => $sequence->user->id
                ]);
            }
            $sent_mail_count += $subscribers->count();
        }

        return $sent_mail_count;
    }

    public static function subscribers(SequenceMail $mail)
    {
        if(!$mail->shouldSendToday())
        {
            return collect([]);
        }

        return $mail->audience()
        ->reject->alreadyReceivedMail($mail)
        ->reject->tooEarlyFor($mail);
    }
}