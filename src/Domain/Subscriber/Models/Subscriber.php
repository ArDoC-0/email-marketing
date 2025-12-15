<?php

namespace Domain\Subscriber\Models;

use Domain\Mail\Models\SentMail;
use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Shared\Concerns\HasUser;
use Domain\Shared\Concerns\WithData;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Scopes\Userscope;
use Domain\Subscriber\Builders\SubscriberBuilder;
use Domain\Subscriber\DataTransferObjects\SubscriberDto;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function tooEarlyFor(SequenceMail $mail)
    {
        return !$mail->enoughTimePassedSince($this->last_received_mail);
    }

    public function last_received_mail() : HasOne
    {
        return $this->hasOne(SentMail::class)
        ->latestOfMany()
        ->withDefault();
    }

    public function sequences(): BelongsToMany
    {
        return $this->belongsToMany(Sequence::class);
    }

    public function received_mails(): HasMany
    {
        return $this->hasMany(SentMail::class);
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function form() : BelongsTo
    {
        return $this->belongsTo(Form::class)->withDefault();
    }

    public function newEloquentBuilder($query)
    {
        return new SubscriberBuilder($query);
    }
}
