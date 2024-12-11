<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=UserSeeder
     */
    public function run(): void
    {
        DB::table('admin_users')->truncate();
        DB::table('users')->truncate();

        DB::table('admin_users')->insert([
            [
                'code' => '1',
                'name'  => 'B. Göymen',
                'username'  => 'bunyaminweblojist',
                'email' => 'bunyamingoymen@gmail.com',
                'type' => 0,
                'can_be_deleted' => '0',
                'password'  => Hash::make('introlistalemi.weblojist.net'),
            ],
            [
                'code' => '2',
                'name'  => 'Admin',
                'username'  => 'adminweblojist',
                'email' => 'adminweblojist@gmail.com',
                'type' => 1,
                'can_be_deleted' => '0',
                'password'  => Hash::make('Hiqmyg-jukfeb-pyvxo1'),
            ]
        ]);
    }
}
