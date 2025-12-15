<?php

namespace App\Http\Controllers\Mail\Broadcast;

use App\Http\Controllers\Controller;
use Domain\Mail\Mails\EchoMail;
use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Mail\ViewModels\Broadcast\PreviewBroadcastViewModel;
use Inertia\Inertia;

class PreviewBroadcastController extends Controller
{
    public function __invoke(Broadcast $broadcast)
    {
        return Inertia::render('Broadcast/Preview', [
            'model' => new PreviewBroadcastViewModel(new EchoMail($broadcast))
        ]);
    }
}