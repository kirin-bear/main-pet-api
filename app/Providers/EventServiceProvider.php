<?php

namespace App\Providers;

use App\Events\User\Created as UserCreated;
use App\Events\Visit\Created as VisitCreated;
use App\Listeners\User\CreatedListener as UserCreatedListener;
use App\Listeners\Visit\CreatedListener as VisitCreatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        VisitCreated::class => [
            VisitCreatedListener::class,
        ],
        UserCreated::class => [
            UserCreatedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
