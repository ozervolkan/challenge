<?php

namespace App\Repositories;

use App\Models\Device;
use Carbon\Carbon;
use Laravel\Sanctum\Guard;

class DeviceRepository
{
    public function getToken($fields)
    {
      //  return Device::where('')
    }

    public function showDevice($id)
    {
        return Device::where('id', $id)
            ->first();
    }

    public function getDevicebyUid($uid)
    {
        return Device::where('uid', $uid)
            ->first();
    }

    public function getWorkerDevice($limit)
    {
        return Device::where('status', 1)
            ->whereDate('expire_date', '<', Carbon::now())
            ->skip(0)->take($limit)
            ->get();
    }
}
