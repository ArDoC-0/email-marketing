<?php

namespace App\Http\Controllers\Broadcast;

use App\Http\Controllers\Controller;
use Domain\Mail\Actions\Broadcast\UpsertBroadcastAction;
use Domain\Mail\DataTransferObjects\Broadcast\BroadcastData;
use Domain\Mail\ViewModels\Broadcast\GetBroadcastViewModel;
use Domain\Mail\ViewModels\Broadcast\UpsertBroadcastViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BroadcastController extends Controller
{
    public function create()
    {
        return Inertia::render('Broadcast/Form', [
            'model' => new UpsertBroadcastViewModel()
        ]);
    }

    public function edit()
    {
        return Inertia::render('Broadcast/Form', [
            'model' => new UpsertBroadcastViewModel()
        ]);
    }

    public function store(
        BroadcastData $broadcastData,
        Request $request
    ) {
        UpsertBroadcastAction::execute(
            $broadcastData,
            $request->user()
        );

        return redirect()->route('broadcast.index');
    }

    public function update(
        BroadcastData $broadcastData,
        Request $request
    ) {
        UpsertBroadcastAction::execute(
            $broadcastData,
            $request->user()
        );

        return redirect()->route('broadcast.index');
    }

    public function index()
    {
        return Inertia::render('Broadcast/Index', [
            'model' => new GetBroadcastViewModel()
        ]);
    }
}
