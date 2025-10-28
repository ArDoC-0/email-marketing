<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscriber\SubscriberRequest;
use Domain\Subscriber\Actions\UpertSubscriberAction;
use Domain\Subscriber\DataTransferObjects\SubscriberDto;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    //
    public function store(SubscriberRequest $subscriberRequest, Request $request)
    {
        $subscriberDto = SubscriberDto::fromRequest($subscriberRequest);

        UpertSubscriberAction::execute($subscriberDto, $request->user());

        return redirect()->route('subscriber.index');
    }

    public function update(SubscriberRequest $subscriberRequest, Request $request)
    {
        $subscriberDto = SubscriberDto::fromRequest($subscriberRequest);

        UpertSubscriberAction::execute($subscriberDto, $request->user());

        return redirect()->route('subscriber.index');
    }
}
