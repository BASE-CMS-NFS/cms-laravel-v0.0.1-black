<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CmsRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_role')->insert([
            ['id'   =>1, 'name' => 'superadmin'],
            ['id'   =>2, 'name' => 'admin'],
            ['id'   =>3, 'name' => 'user'],
        ]);
    }
}
