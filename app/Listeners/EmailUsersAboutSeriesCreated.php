<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\SeriesCreated as SeriesCreatedMail;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{


    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesCreatedEvent $event): void
    {
        $userList = User::all();
        foreach ($userList as $index => $user) {
            $email = new SeriesCreatedMail(
                $event->seriesName,
                $event->serieId,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesPerSeason,
            );
            $when = now()->addSeconds($index * 3);
            Mail::to($user)->later($when, $email);
        }
    }
}
