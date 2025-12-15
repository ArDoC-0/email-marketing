<?php
namespace Domain\Subscriber\ViewModels;

use Domain\Shared\ViewModels\Concerns\HasForms;
use Domain\Shared\ViewModels\Concerns\HasTags;
use Domain\Shared\ViewModels\ViewModel;
use Domain\Subscriber\DataTransferObjects\SubscriberDto;
use Domain\Subscriber\Models\Subscriber;

class UpsertSubscriberViewModel extends ViewModel
{
    use HasTags;
    use HasForms;

    public function __construct(
        public ?Subscriber $subscriber = null,

    )
    {
    }

    public function subscriber() : ?SubscriberDto
    {
        if(!$this->subscriber){
            return null;
        }
        return SubscriberDto::fromArray($this->subscriber->load('tags', 'form')->toArray());
    }
}