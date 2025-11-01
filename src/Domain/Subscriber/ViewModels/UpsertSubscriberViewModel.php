<?php
namespace Domain\Subscriber\ViewModels;

use Domain\Shared\ViewModels\ViewModel;
use Domain\Subscriber\DataTransferObjects\FormDto;
use Domain\Subscriber\DataTransferObjects\SubscriberDto;
use Domain\Subscriber\DataTransferObjects\TagDto;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Subscriber;
use Domain\Subscriber\Models\Tag;

class UpsertSubscriberViewModel extends ViewModel
{

    public function __construct(
        public ?Subscriber $subscriber = null,
        // public Tag $tag,
        // public Form $form
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

    public function forms()
    {
        return Form::all()->map(fn (Form $from) => FormDto::fromArray($from->toArray()))->toArray();
    }

    public function tags()
    {
        return Tag::all()->map(fn (Tag $tag) => TagDto::fromArray($tag->toArray()))->toArray();
    }
}