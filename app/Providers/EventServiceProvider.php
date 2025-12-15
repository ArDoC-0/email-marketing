<?php

namespace App\Providers;

use Domain\Automation\Events\SubscribedToFormEvent;
use Domain\Automation\Listeners\SubscribedToFormSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ProvidersEventServiceProvider;

class EventServiceProvider extends ProvidersEventServiceProvider
{
    protected $listen = [
        SubscribedToFormEvent::class => [
            SubscribedToFormSubscriber::class
        ]
    ];

    public function boot() : void
    {
        parent::boot();
    }
}