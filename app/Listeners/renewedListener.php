<?php

namespace App\Listeners;

use App\Events\Renewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class renewedListener
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
     * @param  \App\Events\Renewed  $event
     * @return void
     */
    public function handle(Renewed $event)
    {
        $response = Http::post($event->endpoint->url, [
            'appId' => $event->device->appId,
            'deviceId' => $event->device->uid,
            'event' => 'renewed',
        ]);
    }
}
