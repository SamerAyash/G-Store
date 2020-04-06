<?php

use Illuminate\Database\Seeder;

class ElectronicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ScreenAndAudioSeeder::class);
        $this->call(ComputerAndLaptopSeeder::class);
        $this->call(HouseholdDeviceSeeder::class);
        $this->call(CameraSeeder::class);
    }
}
