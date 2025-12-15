<?php

namespace Domain\Mail\Models\Concerns;

use Domain\Mail\DataTransferObjects\FilterData;
use Domain\Subscriber\Enums\Filters;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pipeline\Pipeline;

trait HasAudience
{

    abstract public function filters() : FilterData;

    abstract public function audienceQuery() : Builder;

    public function audience() : Collection
    {

        /**
         * $filters is a collection of tagFilter and FormFiter containing handle method
         */
        $filters = collect($this->filters()->toArray())
        ->map(fn (array $ids, string $key) =>

             Filters::from($key)->createFilter($ids)

        )
        ->values()
        ->all();

        return app(Pipeline::class)
        ->send($this->audienceQuery())
        ->through($filters)
        ->get();
    }
}