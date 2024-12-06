<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Run this seeder code: php artisan db:seed --class=TranslationSeeder
     */
    public function run(): void
    {
        DB::table('translations')->truncate();

        $this->call(translation\AdminLangSeeder::class);
        $this->call(translation\IndexLangSeeder::class);
        $this->call(translation\UserLangSeeder::class);
    }
}
