<?php

namespace App\Repositories;

use App\Models\Listenendpoint;

class ListenendpointRepository
{


    public function showDevice($appId)
    {
        return Listenendpoint::where('appId', $appId)
            ->first();
    }
}
