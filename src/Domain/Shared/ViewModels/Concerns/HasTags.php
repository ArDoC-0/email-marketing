<?php

namespace Domain\Shared\ViewModels\Concerns;

use Domain\Subscriber\DataTransferObjects\TagDto;
use Domain\Subscriber\Models\Tag;

trait HasTags
{
    public function tags()
    {
        return Tag::all()->map(fn(Tag $tag) => TagDto::fromArray($tag->toArray()))->toArray();
    }
}
