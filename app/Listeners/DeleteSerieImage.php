<?php

namespace App\Listeners;

use App\Events\SeriesDeleted;
use Illuminate\Support\Facades\Storage;

class DeleteSerieImage
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
    public function handle(SeriesDeleted $event): void
    {
        Storage::disk('public')->delete($event->cover);
    }
}
