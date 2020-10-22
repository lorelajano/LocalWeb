<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
Use DB;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole=Role::where('name','admin')->first();
        $managerRole=Role::where('name','manager')->first();

        $admin= User::create([
            'name'=>'System Admin',
            'email'=>'admin@admin.al',
            'password'=>Hash::make('Admin@12345'),
            'birthday'=>null,
            'status_id'=>'1',


        ]);
        $manager= User::create([
            'name'=>'System Manager',
            'email'=>'manager@manager.al',
            'password'=>Hash::make('Manager@12345'),
            'birthday'=>null,
            'status_id'=>'1',
        ]);


        $admin->roles()->attach($adminRole);
        $manager->roles()->attach($managerRole);


    }
}
