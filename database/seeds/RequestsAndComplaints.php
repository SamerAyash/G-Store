<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RequestsAndComplaints extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facker = \Faker\Factory::create();
        for ($i=0 ;$i< 20;$i++){
            $request =\App\Request::create([
                'email'=>$facker->email,
                'description'=>$facker->text
            ]);
        }
    }
}
