<?php

namespace Domain\Subscriber\Models;

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

// #[ScopedBy([Userscope::class])]
class Subscriber extends BaseModel
{
    use HasUser;

    protected $dataClass = SubscriberDto::class;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'form_id',
        'user_id'
    ];

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function form() : BelongsTo
    {
        return $this->belongsTo(Form::class)->withDefault();
    }
}
