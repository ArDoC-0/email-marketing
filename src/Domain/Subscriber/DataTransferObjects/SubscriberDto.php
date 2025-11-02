<?php
namespace Domain\Subscriber\DataTransferObjects;

use App\Http\Requests\Subscriber\SubscriberRequest;
use Domain\Shared\CommonDto\CommonDto;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as SupportCollection;

class SubscriberDto extends CommonDto
{

    public function __construct (
        public readonly ?int $id,
        public readonly string $email,
        public readonly string $first_name,
        public readonly string $last_name,

        public readonly SupportCollection|Collection $tags,
        public readonly ?FormDto $form
    )
    {}

    public static function fromRequest(SubscriberRequest $request)
    {
        return new self(
            id: $request->id,
            email: $request->email,
            first_name: $request->first_name,
            last_name: $request->last_name,

            tags: TagDto::collection(
                Tag::whereIn('id', $request->tag_ids)->get()
            ),
            form: FormDto::fromArray(Form::find($request->form_id)?->toArray())
        );
    }
}