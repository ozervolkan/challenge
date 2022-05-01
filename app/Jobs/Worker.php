<?php

namespace App\Jobs;

use App\Constant;
use App\Models\Device;
use App\Repositories\DeviceRepository;
use App\Services\Purchase\ApplePurchase;
use App\Services\Purchase\GooglePurchase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class Worker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DeviceRepository $deviceRepository)
    {

        $devices = $deviceRepository->getWorkerDevice(Constant::WORKER_LIMIT);

        foreach ($devices as $device) {

            if($device->os == Constant::ANDROID_OS_KEY){
                $response = app(GooglePurchase::class)->send(['receipt'=> $device['receipt']]);
            } elseif ($device->os == Constant::IOS_OS_KEY){
                $response = app(ApplePurchase::class)->send(['receipt'=> $device['receipt']]);
            }
            if($response['status']){
                $data['expire_date'] = $response['expire_date'];
                $data['status'] = 1;

                $response =file_get_contents('http://gitgezgel.com/volkan/dosya.php?test='.$device['uid']. ' Update');
            } else {
                $data['status'] = 0;
                $response =file_get_contents('http://gitgezgel.com/volkan/dosya.php?test='.$device['uid']. ' NON');
            }
            $device->update($data);
            sleep(3);
        }
    }
}
