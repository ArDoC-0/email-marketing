<?php

namespace Domain\Mail\ViewModels\Broadcast;

use Domain\Mail\Actions\GetPerformanceAction;
use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Shared\ViewModels\ViewModel;
use Illuminate\Database\Eloquent\Collection;

class GetBroadcastViewModel extends ViewModel
{
    public function __construct() {}

    public function broadcasts(): Collection
    {
        return Broadcast::latest()->get()->map()->getData();
    }

    public function performances(): Collection
    {

        return Broadcast::all()
        ->mapWithKeys(fn (Broadcast $broadcast) => [
            $broadcast->id => $broadcast->performance()
        ]);

    }
}
