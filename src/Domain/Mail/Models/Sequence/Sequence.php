<?php
namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Builder\Sequence\SequenceBuilder;
use Domain\Mail\Contracts\Sendable;
use Domain\Mail\DataTransferObjects\PerformanceData;
use Domain\Mail\Models\Concerns\HasPerformance;
use Domain\Mail\Models\SentMail;
use Domain\Shared\Concerns\HasUser;
use Domain\Shared\Models\BaseModel;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Sequence extends BaseModel 
{
    use HasUser;
    use HasPerformance;
    
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

    public function sent_mails() : HasManyThrough
    {
        return $this->hasManyThrough(SentMail::class, SequenceMail::class);
    }

    public function newEloquentBuilder($query)
    {
        return new SequenceBuilder($query);
    }

    public function performance(): PerformanceData
    {
        $total = $this->activeSubscriberCount();

        return PerformanceData::from(
            total: $total,
            open_rate: $this->openRate($total),
            click_rate: $this->clickRate($total)
        );
    }

}