<?php

namespace Domain\Mail\ViewModels\Broadcast;

use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Shared\ViewModels\Concerns\HasForms;
use Domain\Shared\ViewModels\Concerns\HasTags;
use Domain\Shared\ViewModels\ViewModel;

class UpsertBroadcastViewModel extends ViewModel
{
    use HasForms;
    use HasTags;

    public function __construct(
        public readonly ?Broadcast $broadcast = null
    )
    {
        
    }

    public function broadcast()
    {
        if(!$this->broadcast)
        {
            return;
        }

        return $this->broadcast->getData();
    }
}