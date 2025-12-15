<?php

namespace Domain\Subscriber\Filters;

use Closure;
use Domain\Subscriber\Filters\Filter;
use Domain\Subscriber\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class FormFilter extends Filter
{
    public function handle(Builder $subscribers, Closure $next) : Builder
    {
        if(count($this->ids) == 0)
        {
            return $next($subscribers);
        }

        // $subscribers->whereHas('forms', fn(Builder $forms) => $forms->whereIn('id', $this->ids));
        $subscribers->whereIn('form_id', $this->ids);

        return $next($subscribers);
    }
}