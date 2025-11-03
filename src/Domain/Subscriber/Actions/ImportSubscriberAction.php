<?php

namespace Domain\Subscriber\Actions;

use Domain\Shared\Actions\ReadCsvAction;
use Domain\Shared\Models\User;
use Domain\Subscriber\DataTransferObjects\SubscriberDto;
use Domain\Subscriber\DataTransferObjects\TagDto;
use Domain\Subscriber\Models\Subscriber;
use Domain\Subscriber\Models\Tag;
use Domain\Subscriber\ViewModels\UpsertSubscriberViewModel;
use Illuminate\Support\Facades\Storage;
use Domain\Subscriber\Actions\UpertSubscriberAction;

class ImportSubscriberAction
{
    public static function execute(string $path, User $user)
    {
        // $path = Storage::disk('public')->path('Subscriber.csv');
        // $user = User::find(1);

        $data = ReadCsvAction::execute($path);

        collect($data)->each(function (array $row) use ($user) {

            $subs = SubscriberDto::fromArray([
                ...$row,
                'id' => null,
                'tags' => self::parseTags($row['tags'], $user),
                'form' => null
            ]);
            
            if(self::isSubscriberExst($subs, $user)) {
                return;
            }

            UpsertSubscriberAction::execute($subs, $user);
        });
    }

    /**
     * Tags are still strings like 'tag1, tag2'
     * @param string
     * @return array
     */
    public static function parseTags(string $tags, User $user)
    {
        $tags = collect(explode(',', $tags))
            ->filter()
            ->toArray();
        return self::getOrCreateTag($tags, $user);
    }

    /**
     * Tags are stored in array
     */
    public static function getOrCreateTag(array $tags, User $user)
    {
        return collect($tags)
            ->map(function (string $tag) use ($user) {
                return Tag::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'title' => $tag,
                    ]
                );
                return Tag::where('title', $tag)->where('user_id', $user->id)->exists() ?
                    $tag : Tag::create([
                        'user_id' => $user->id,
                        'title' => $tag,
                    ]);
            });
    }

    public static function isSubscriberExst(SubscriberDto $subs, User $user): bool
    {
        return Subscriber::query()
            ->where('email', $subs->email)
            ->whereBelongsTo($user)
            ->exists();
    }
}
