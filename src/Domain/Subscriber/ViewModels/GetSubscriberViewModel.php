<?php

namespace Domain\Subscriber\ViewModels;

use Domain\Shared\ViewModels\ViewModel;
use Domain\Subscriber\DataTransferObjects\FormDto;
use Domain\Subscriber\DataTransferObjects\SubscriberDto;
use Domain\Subscriber\DataTransferObjects\TagDto;
use Domain\Subscriber\Models\Subscriber;
use Domain\Subscriber\Models\Tag;
use Illuminate\Pagination\Paginator;
use Spatie\LaravelData\Lazy;

class GetSubscriberViewModel extends ViewModel
{
    public const PER_PAGE = 15;

    public function __construct(
        public readonly ?int $currentPage
    ) {}

    public function subscribers()
    {
        $subscriber = new Subscriber();
        $items = Subscriber::with(['form', 'tags'])->get()
            ->map(fn(Subscriber $subscriber) => SubscriberDto::fromArray(
                [
                    ...$subscriber->toArray(),
                    'tags' => TagDto::collection($subscriber->tags),
                    'form' => FormDto::fromArray($subscriber->form->toArray()),

                ]
            ));

        $items = collect($items)->slice(($this->currentPage - 1) * self::PER_PAGE);

        return new Paginator(
            $items,
            self::PER_PAGE,
            $this->currentPage,
            [
                'path' => route('subscriber.index')
            ]
        );
    }

    public function count()
    {
        return Subscriber::count();
    }
}
