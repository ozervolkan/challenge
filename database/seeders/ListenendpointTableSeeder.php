<?php

namespace Database\Seeders;

use App\Models\Listenendpoint;
use Illuminate\Database\Seeder;

class ListenendpointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Listenendpoint::create([
            'appId' => 'ABCAPPID',
            'url' => 'http://gitgezgel.com/volkan/dosya.php'
        ]);

        Listenendpoint::create([
            'appId' => 'DEFPPID',
            'url' => 'http://gitgezgel.com/volkan/dosya.php'
        ]);

        Listenendpoint::create([
            'appId' => 'HIJPPID',
            'url' => 'http://gitgezgel.com/volkan/dosya.php'
        ]);
    }
}
