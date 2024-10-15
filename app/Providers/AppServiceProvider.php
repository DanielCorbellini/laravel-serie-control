<?php

namespace App\Providers;

use App\Events\SeriesCreated;
use App\Events\SeriesDeleted;
use App\Listeners\DeleteSerieImage;
use App\Listeners\LogSeriesCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Listeners\EmailUsersAboutSeriesCreated;

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
        Event::listen(
            [SeriesCreated::class],
            [EmailUsersAboutSeriesCreated::class, LogSeriesCreated::class],
        );

        Event::listen(
            SeriesDeleted::class,
            DeleteSerieImage::class,
        );
    }
}
