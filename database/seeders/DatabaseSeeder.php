<?php

namespace Database\Seeders;

use App\Http\Controllers\MainController;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TranslationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KeyValueSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(MenuSeeder::class);
        //$this->call(TempSeeder::class);
    }
}
