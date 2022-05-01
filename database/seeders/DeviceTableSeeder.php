<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $os = [
            'Andoid',
            'IOS'
        ];
        $lang = [
            'tr',
            'en',
            'fr'
        ];
        $apps = [
            'ABCAPPID',
            'DEFPPID',
            'HIJPPID'
        ];
        for($x=0; $x<3000; $x++){
            $expire = $this->getDateTime('Etc/GMT-6', 'Y-m-d H:i:s', rand(1,365));
            Device::create([
                'uid' => uniqid(),
                'appId' => $apps[rand(0,2)],
                'os' => $os[rand(0,1)],
                'language' => $lang[rand(0,2)],
                'status' =>  rand(0,1),
                'purchase_date' => date('Y-m-d H:i:s', strtotime($expire. ' -180 days')),
                'expire_date' => $expire,
                'receipt'=> uniqid()
            ]);
        }
    }


    private function getDateTime($timezone, $format, $addDay) {
        $dt = new \DateTime('now +'.$addDay.' days');
        $dt->setTimezone(new \DateTimeZone($timezone));
        return $dt->format($format);
    }
}
