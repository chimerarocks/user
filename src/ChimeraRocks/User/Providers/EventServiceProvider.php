<?php

namespace ChimeraRocks\User\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \ChimeraRocks\User\Events\UserCreatedEvent::class =>[
            \ChimeraRocks\User\Listeners\EmailCreatedAccountListener::class
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //$events->listen('event.chimerarocks', function () {})
        //$events->listen('event.chimerarocks', 'Class\function')
    }
}
