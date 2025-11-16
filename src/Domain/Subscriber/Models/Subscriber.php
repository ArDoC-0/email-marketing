<?php

namespace Domain\Subscriber\Models;

use Domain\Mail\Models\Sequence\Sequence;
use Domain\Shared\Concerns\HasUser;
use Domain\Shared\Concerns\WithData;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Scopes\Userscope;
use Domain\Subscriber\DataTransferObjects\SubscriberDto;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

// #[ScopedBy([Userscope::class])]
class Subscriber extends BaseModel
{
    use HasUser;
    use Notifiable;

    protected $dataClass = SubscriberDto::class;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'form_id',
        'user_id'
    ];

    public function sequences(): BelongsToMany
    {
        return $this->belongsToMany(Sequence::class);
    }
    
    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function form() : BelongsTo
    {
        return $this->belongsTo(Form::class)->withDefault();
    }
}
