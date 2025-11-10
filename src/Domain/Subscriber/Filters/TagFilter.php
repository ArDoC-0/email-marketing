<?php
namespace Domain\Subscriber\Filters;

use Closure;
use Domain\Subscriber\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class TagFilter extends Filter
{

    public function handle(Builder $subscribers, Closure $next) : Builder
    {
        if(count($this->ids) == 0)
        {
            return $next($subscribers);
        }

        // $subscribers->whereJsonContains('filters->tag_ids', $this->ids);
        $subscribers->whereHas('tags', function(Builder $tag) {

            $tag->whereIn('tags.id', $this->ids);
        } 
    );

        return $next($subscribers);
    }
}