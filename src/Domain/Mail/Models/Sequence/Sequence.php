<?php
namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Builder\Sequence\SequenceBuilder;
use Domain\Mail\Contracts\Sendable;
use Domain\Shared\Models\BaseModel;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sequence extends BaseModel 
{
    protected $table = 'sequences';

    protected $fillable = [
        'title',
        'status'
    ];

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class);
    }

    public function sequence_mails(): HasMany
    {
        return $this->hasMany(SequenceMail::class);
    }

    public function newEloquentBuilder($query)
    {
        return new SequenceBuilder($query);
    }

}