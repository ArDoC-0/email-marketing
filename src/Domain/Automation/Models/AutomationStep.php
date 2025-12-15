<?php

namespace Domain\Automation\Models;

use Domain\Automation\Builders\AutomationStepBuilder;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AutomationStep extends BaseModel
{
    protected $fillable = [
        'name',
        'type',
        'value',
        'automation_id'
    ];

    public function automation() : BelongsTo
    {
        return $this->belongsTo(Automation::class);
    }

    public function newEloquentBuilder($query)
    {
        return new AutomationStepBuilder($query);
    }
}