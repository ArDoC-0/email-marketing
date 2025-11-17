<?php
namespace Domain\Mail\Actions\Sequence;

use Domain\Mail\DataTransferObjects\Sequence\SequenceMailData;
use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Shared\Models\User;

class UpsertSequenceMailAction
{
    public static function execute(
        SequenceMailData $sequence_mail_data, 
        Sequence $sequence, 
        User $user
    ) : SequenceMail
    {

        return SequenceMail::updata0rCreate([
            [
                'id' => $sequence_mail_data->id
            ],
            [
                ...$sequence_mail_data->all(),
                'sequence_id' => $sequence->id,
                'user_id' => $user->id
            ]
            
        ]);
    }
}