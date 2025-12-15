<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use Domain\Subscriber\Jobs\ImportSubscriberJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class ImportSubscriberController extends Controller
{
    public function __invoke(Request $request)
    {
        ImportSubscriberJob::dispatch(
            storage_path('Subscriber/Subscriber.csv'),
            $request->user()
        );

        return response('', HttpResponse::HTTP_ACCEPTED);
    }
}
