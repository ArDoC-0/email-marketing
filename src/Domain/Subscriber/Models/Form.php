<?php

namespace Domain\Subscriber\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    //
    public function Subscriber() : HasMany
    {
        return $this->hasMany(Subscriber::class);
    }
}
