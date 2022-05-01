<?php

namespace App\Repositories;

use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

    public function getReporting()
    {
        $report_started = DB::select('select  DATE(purchase_date) as date, os, count(DATE(purchase_date)) as started
 from laravel.devices
GROUP BY os, DATE(purchase_date)
order by DATE(purchase_date)');

        $report_ended = DB::select('select  DATE(expire_date) as date, os, count(DATE(expire_date)) as ended
 from laravel.devices
GROUP BY os, DATE(expire_date)
order by DATE(expire_date)');


        $response = [];
        foreach ($report_started as &$start){
            $response[$start->date.'-'.$start->os] = $start;
            $response[$start->date.'-'.$start->os]->ended = 0;
        }

        foreach ($report_ended as &$end){
            if(!isset($response[$end->date.'-'.$end->os] )){
                $response[$end->date.'-'.$end->os] = (object)['started'=>0];
            }
            $response[$end->date.'-'.$end->os]->date = $end->date;
            $response[$end->date.'-'.$end->os]->os = $end->os;
            $response[$end->date.'-'.$end->os]->ended = $end->ended;
        }

        return $response;
    }
}
