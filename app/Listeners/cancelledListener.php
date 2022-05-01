<?php

namespace App\Listeners;

use App\Events\Cancelled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class cancelledListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Cancelled  $event
     * @return void
     */
    public function handle(Cancelled $event)
    {
        $response = Http::post($event->endpoint->url, [
            'appId' => $event->device->appId,
            'deviceId' => $event->device->uid,
            'event' => 'cancelled',
        ]);
    }
}
