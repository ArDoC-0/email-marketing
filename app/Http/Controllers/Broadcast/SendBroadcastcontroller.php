<?php

namespace App\Http\Controllers\Broadcast;

use App\Http\Controllers\Controller;
use Domain\Mail\Jobs\Broadcast\SendBroadcastJob;
use Domain\Mail\Models\Broadcast\Broadcast;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SendBroadcastcontroller extends Controller
{
    //
    public function __invoke(Broadcast $broadcast)
    {
        SendBroadcastJob::dispatch($broadcast);

        return response('', Response::HTTP_ACCEPTED);
    }
}
