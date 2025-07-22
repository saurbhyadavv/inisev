<?php

namespace App\Providers;

use App\Events\PostCreated;
use App\Listeners\ScheduleEmailNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostCreated::class => [
            ScheduleEmailNotification::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}