<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'cms_role_id' => 1,
                'name'  =>'nonscrap',
                'email'=>'superadmin@nonscrap.com',
                'phone'=>'088220148340',
                'status'=>'active',
                'password'=>Hash::make('123456')
            ],

            [
                'cms_role_id' => 2,
                'name'  =>'nonscrap',
                'email'=>'admin@nonscrap.com',
                'phone'=>'082238982100',
                'status'=>'active',
                'password'=>Hash::make('123456')
            ],


        ]);
    }
}
