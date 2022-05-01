<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DeviceTableSeeder::class);
        $this->call(ListenendpointTableSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
