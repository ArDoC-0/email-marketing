<?php

namespace Domain\Subscriber\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends BaseModel
{
    public function Subscriber() : HasMany
    {
        return $this->hasMany(Subscriber::class);
    }
}
