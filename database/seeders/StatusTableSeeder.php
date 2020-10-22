<?php

namespace Database\Seeders;

use App\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();
        Status::create(['name' =>'confirmed']);
        Status::create(['name' =>'processing']);
        Status::create(['name' =>'pending']);
    }
}
