<?php

namespace Domain\Mail\Actions\Sequence;

use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Subscriber\Actions\FilterSubscribersAction;

class ProcessSequenceAction
{
    public static function execute(Sequence $sequence)
    {
        // $sequence->sequence_mails()->
    }

    public static function subscribers()
    {
        // return FilterSubscribersAction::execute()
    }
}