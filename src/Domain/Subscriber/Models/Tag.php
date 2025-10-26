<?php

namespace Domain\Subscriber\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'title',
    ];

    public function subscribers() : BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class);
    }
}
