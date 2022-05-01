<?php

namespace App\Listeners;

use App\Events\Started;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class startedtListener
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
     * @param  \App\Events\Started  $event
     * @return void
     */
    public function handle(Started $event)
    {
        $response = Http::post($event->endpoint->url, [
            'appId' => $event->device->appId,
            'deviceId' => $event->device->uid,
            'event' => 'started',
        ]);
    }
}
