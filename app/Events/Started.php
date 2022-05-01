<?php

namespace App\Events;

use App\Models\Listenendpoint;
use App\Repositories\DeviceRepository;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Repositories\ListenendpointRepository;
use App\Models\Device;

class Started
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $device;
    public $endpoint;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($device)
    {
        $this->device = $device;
        $listenendpointRepository = new ListenendpointRepository();
        $this->endpoint = $listenendpointRepository->showDevice($device['appId']);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
