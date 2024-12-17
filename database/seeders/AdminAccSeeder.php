<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAccSeeder extends Seeder
{
    public function run()
    {
        $admin = [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_type' => 2 // admin
        ];

        DB::table('admins')->insert($admin);
    }
}
