<?php

namespace Domain\Subscriber\Actions;

use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Subscriber\Enums\Filters;
use Domain\Subscriber\Filters\Filter;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Pipeline\Pipeline;
use Symfony\Component\CssSelector\Node\FunctionNode;

class FilterSubscribersAction
{

    public static function execute(Broadcast $broadcast)
    {
        // $broadcast = Broadcast::find(1);
        return app(Pipeline::class)
        ->send(Subscriber::query())
        ->through(self::filters($broadcast))
        ->thenReturn()
        ->get();
    }

    public static function filters(Broadcast $broadcast)
    {
        return collect($broadcast->filters->toArray())
        ->map(fn (array $ids, string $key) => Filters::from($key)->createFilter($ids))
        ->values()
        ->all();
    }
}