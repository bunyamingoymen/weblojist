<?php

namespace Database\Seeders;

use App\Http\Controllers\MainController;
use Faker\Provider\Lorem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->truncate();

        $mainController = new MainController();

        DB::table('pages')->insert([
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'Hakkımızda',
                'short_name'           => 'about',
                'description'   => 'Hakkımızda',
                'type'          => 2,
                'can_be_deleted' => 0,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'Gizlilik Politikası',
                'short_name'           => 'privacy_policy',
                'description'   => 'Gizlilik Politikası',
                'type'          => 2,
                'can_be_deleted' => 0,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'Şartlar Ve Koşullar',
                'short_name'           => 'terms_and_conditions',
                'description'   => 'Şartlar Ve Koşullar',
                'type'          => 2,
                'can_be_deleted' => 0,
            ],
        ]);

        DB::table('pages')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'pages']),
                'sub_title'         => 'What We Do',
                'title'             => 'We Are Digital',
                'short_name'        => 'home-show',
                'description'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam semper ex ac velit varius semper. Mauris at dolor nec ante ultricies aliquam ac vitae diam. Quisque sodales vehicula elementum. Phasellus tempus tellus vitae ullamcorper hendrerit.',
                'image'             => 'defaultFiles/page/home_1.jpeg',
                'type'              => 2,
                'can_be_deleted'    => 0,
                'show_home'         => 1,
                'home_type'         => 0,
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'pages']),
                'sub_title'         => 'About Us',
                'title'             => 'We Are Partners',
                'short_name'               => 'home-show-2',
                'description'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam semper ex ac velit varius semper. Mauris at dolor nec ante ultricies aliquam ac vitae diam. Quisque sodales vehicula elementum. Phasellus tempus tellus vitae ullamcorper hendrerit.',
                'image'             => 'defaultFiles/page/home_2.jpg',
                'type'              => 2,
                'can_be_deleted'    => 0,
                'show_home'         => 1,
                'home_type'         => 1,
            ],
        ]);

        DB::table('pages')->insert([
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'A',
                'short_name'           => 'a',
                'description'   => 'a',
                'image'         => 'defaultFiles/page/supplier_1.png',
                'type'          => 3,
                'can_be_deleted' => 0,
                'show_home'         => 1,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'B',
                'short_name'           => 'b',
                'description'   => 'b',
                'image'         => 'defaultFiles/page/supplier_2.png',
                'type'          => 3,
                'can_be_deleted' => 0,
                'show_home'         => 1,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'C',
                'short_name'           => 'c',
                'description'   => 'c',
                'image'         => 'defaultFiles/page/supplier_3.png',
                'type'          => 3,
                'can_be_deleted' => 0,
                'show_home'         => 1,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'D',
                'short_name'           => 'd',
                'description'   => 'd',
                'image'         => 'defaultFiles/page/supplier_4.png',
                'type'          => 3,
                'can_be_deleted' => 0,
                'show_home'         => 1,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'E',
                'short_name'           => 'e',
                'description'   => 'e',
                'image'         => 'defaultFiles/page/supplier_5.png',
                'type'          => 3,
                'can_be_deleted' => 0,
                'show_home'         => 1,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'F',
                'short_name'           => 'f',
                'description'   => 'f',
                'image'         => 'defaultFiles/page/supplier_6.png',
                'type'          => 3,
                'can_be_deleted' => 0,
                'show_home'         => 1,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'G',
                'short_name'           => 'g',
                'description'   => 'g',
                'image'         => 'defaultFiles/page/supplier_7.png',
                'type'          => 3,
                'can_be_deleted' => 0,
                'show_home'         => 1,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'H',
                'short_name'           => 'h',
                'description'   => 'h',
                'image'         => 'defaultFiles/page/supplier_8.png',
                'type'          => 3,
                'can_be_deleted' => 0,
                'show_home'         => 1,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'I',
                'short_name'           => 'i',
                'description'   => 'i',
                'image'         => 'defaultFiles/page/supplier_9.png',
                'type'          => 3,
                'can_be_deleted' => 0,
                'show_home'         => 1,
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'pages']),
                'title'         => 'J',
                'short_name'           => 'j',
                'description'   => 'j',
                'image'         => 'defaultFiles/page/supplier_10.png',
                'type'          => 3,
                'can_be_deleted' => 0,
                'show_home'         => 1,
            ],

        ]);
    }
}
