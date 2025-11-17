<?php

namespace Domain\Subscriber\Actions;

use Domain\Mail\Contracts\Sendable;
use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Subscriber\Enums\Filters;
use Domain\Subscriber\Filters\Filter;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Pipeline\Pipeline;
use Symfony\Component\CssSelector\Node\FunctionNode;

class FilterSubscribersAction
{

    public static function execute(Sendable $mail)
    {
        // $broadcast = Broadcast::find(1);
        return app(Pipeline::class)
        ->send(Subscriber::query())
        ->through(self::filters($mail))
        ->thenReturn()
        ->get();
    }

    public static function filters(Sendable $mail)
    {
        return collect($mail->filters()->toArray())
        ->map(fn (array $ids, string $key) => Filters::from($key)->createFilter($ids))
        ->values()
        ->all();
    }
}