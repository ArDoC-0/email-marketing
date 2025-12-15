<?php
namespace Domain\Mail\ViewModels\Sequence;

use Domain\Mail\DataTransferObjects\Sequence\SequenceData;
use Domain\Mail\DataTransferObjects\Sequence\SequenceProgressData;
use Domain\Mail\Models\SentMail;
use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Shared\ViewModels\ViewModel;

class GetSequenceReportViewModel extends ViewModel
{
    public function __construct(
        private readonly Sequence $sequence
    )
    {
    }

    public function sequence() : SequenceData
    {
        return $this->sequence->getData();
    }

    public function totalPerformance()
    {
        return $this->sequence->performance();
    }

    public function mailPerformances()
    {

        return $this->sequence->sequence_mails
        ->mapWithKeys(fn (SequenceMail $mail) => [
            $mail->id => $mail->performance()
        ]);
    }

    public function progress()
    {
        return new SequenceProgressData(
            total: $this->sequence->activeSubscriberCount(),
            in_progress: $this->sequence->inProgressSubscriberCount(),
            completed: $this->sequence->completedSubscriberCount()
        );
    }

}