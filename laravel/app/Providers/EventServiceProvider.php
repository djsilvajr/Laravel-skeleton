<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Events\UserRegisteredSendEmail;
use App\Listeners\SendWelcomeEmailListener;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        UserRegisteredSendEmail::class => [
            SendWelcomeEmailListener::class,
        ],
    ];

    public function register(): void { }

    public function boot(): void { }
}
