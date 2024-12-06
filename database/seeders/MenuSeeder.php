<?php

namespace Database\Seeders;

use App\Http\Controllers\MainController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->truncate();

        $mainController = new MainController();

        DB::table('menus')->insert([
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'menus']),
                'type'          => 'header',
                'top_category'  => '0',
                'title'         => 'Ürünler',
                'path'          => 'products',
                'row'           => '1',
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'menus']),
                'type'          => 'header',
                'top_category'  => '0',
                'title'         => 'Blog',
                'path'          => 'blogs',
                'row'           => '2',
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'menus']),
                'type'          => 'header',
                'top_category'  => '0',
                'title'         => 'Galeri',
                'path'          => 'gallery',
                'row'           => '2',
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'menus']),
                'type'          => 'header',
                'top_category'  => '0',
                'title'         => 'Hakkımızda',
                'path'          => '/p/about',
                'row'           => '3',
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'menus']),
                'type'          => 'header',
                'top_category'  => '0',
                'title'         => 'İletişim',
                'path'          => 'contact',
                'row'           => '4',
            ],
        ]);
    }
}
