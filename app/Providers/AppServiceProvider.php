<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ClassCreated;
use App\Events\ClassUpdated;
use App\Events\ClassDeleted;
use App\Events\UserJoinedClass;
use App\Events\UserLeftClass;
use App\Events\UserRemovedFromClass;
use App\Events\ClassCodeRegenerated;
use App\Listeners\SendClassNotificationListener;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(ClassCreated::class, SendClassNotificationListener::class);
        Event::listen(ClassUpdated::class, SendClassNotificationListener::class);
        Event::listen(ClassDeleted::class, SendClassNotificationListener::class);
        Event::listen(UserJoinedClass::class, SendClassNotificationListener::class);
        Event::listen(UserLeftClass::class, SendClassNotificationListener::class);
        Event::listen(UserRemovedFromClass::class, SendClassNotificationListener::class);
        Event::listen(ClassCodeRegenerated::class, SendClassNotificationListener::class);
    }
}

