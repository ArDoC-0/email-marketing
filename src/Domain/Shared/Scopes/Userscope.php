<?php
namespace Domain\Shared\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Userscope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if($user = request()->user())
        {
            return $builder->whereBelongsTo($user);
        }
    }
}