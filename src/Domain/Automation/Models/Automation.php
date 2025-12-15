<?php

namespace Domain\Automation\Models;

use Domain\Shared\Concerns\HasUser;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Automation extends BaseModel
{
    use HasUser;

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function steps() : HasMany
    {
        return $this->hasMany(Automation::class);
    }

}