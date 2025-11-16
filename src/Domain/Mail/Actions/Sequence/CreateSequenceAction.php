<?php

namespace Domain\Mail\Actions\Sequence;

use Domain\Mail\DataTransferObjects\Sequence\SequenceData;
use Domain\Mail\DataTransferObjects\Sequence\SequenceMailData;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Shared\Models\User;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Support\Facades\DB;

class CreateSequenceAction
{
    public static function execute(SequenceData $data, User $user)
    {
        return DB::transaction(function () use ($data, $user){

            $sequence = SequenceMail::create([
                ...$data->all(),
                'user_id' => $user->id
            ]);

            UpsertSequenceMailAction::execute(
                SequenceMailData::dummy(),
                $sequence, 
                $user
            );
            
            $sequence->subscribers()->sync(Subscriber::select('id')->pluck('id'));

            return $sequence;
        });
    }
}