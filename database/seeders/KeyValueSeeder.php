<?php

namespace Database\Seeders;

use App\Http\Controllers\MainController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('key_values')->truncate();

        $mainController = new MainController();

        //Diller
        DB::table('key_values')->insert([
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'           => 'language',
                'value'         => 'Türkçe',
                'optional_1'    => 'tr',
                'optional_2'    => 'main_language',
                'optional_5'    => 'file/flags/tr.png',
            ],
            [
                'code'          => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'           => 'language',
                'value'         => 'English',
                'optional_1'    => 'en',
                'optional_2'    => '',
                'optional_5'    => 'file/flags/en.jpg',
            ]
        ]);

        //Başlık ve tanıtım
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'site_title',
                'value'             => 'Başlık',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'site_description',
                'value'             => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam semper ex ac velit varius semper. Mauris at dolor nec ante ultricies aliquam ac vitae diam. Quisque sodales vehicula elementum. Phasellus tempus tellus vitae ullamcorper hendrerit.',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ]
        ]);

        //Sosyal Medya
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'social_media',
                'value'             => '',
                'optional_1'        => 'Facebook',
                'optional_2'        => 'mdi mdi-facebook',
                'optional_3'        => 'facebook',
                'optional_4'        => 'fa-brands fa-facebook-f',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'social_media',
                'value'             => '',
                'optional_1'        => 'X (Twitter)',
                'optional_2'        => 'mdi mdi-twitter',
                'optional_3'        => 'twitter',
                'optional_4'        => 'fa-brands fa-x-twitter',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'social_media',
                'value'             => '',
                'optional_1'        => 'Instagram',
                'optional_2'        => 'mdi mdi-instagram',
                'optional_3'        => 'instagram',
                'optional_4'        => 'fa-brands fa-instagram',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'social_media',
                'value'             => '',
                'optional_1'        => 'Linkedin',
                'optional_2'        => 'mdi mdi-linkedin',
                'optional_3'        => 'linkedin',
                'optional_4'        => 'fa-brands fa-linkedin-in',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'social_media',
                'value'             => '',
                'optional_1'        => 'Youtube',
                'optional_2'        => 'mdi mdi-youtube',
                'optional_3'        => 'youtube',
                'optional_4'        => 'fa-brands fa-youtube',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'social_media',
                'value'             => '',
                'optional_1'        => 'Pinterest',
                'optional_2'        => 'mdi mdi-pinterest',
                'optional_3'        => 'pinterest',
                'optional_4'        => 'fa-brands fa-pinterest',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'social_media',
                'value'             => '',
                'optional_1'        => 'Whatsapp',
                'optional_2'        => 'mdi mdi-whatsapp',
                'optional_3'        => 'whatsapp',
                'optional_4'        => 'fa-brands fa-whatsapp',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'social_media',
                'value'             => '',
                'optional_1'        => 'Telegram',
                'optional_2'        => 'mdi mdi-telegram',
                'optional_3'        => 'telegram',
                'optional_4'        => 'fa-brands fa-telegram',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'social_media',
                'value'             => '',
                'optional_1'        => 'Discord',
                'optional_2'        => 'mdi mdi-discord',
                'optional_3'        => 'discord',
                'optional_4'        => 'fa-brands fa-discord',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'social_media',
                'value'             => '',
                'optional_1'        => 'Website',
                'optional_2'        => 'fas fa-globe',
                'optional_3'        => 'website',
                'optional_4'        => 'fa-solid fa-globe',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],

        ]);

        //Arkaplanlar
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgroudSettings',
                'value'             => 'video', //picture, silder ya da resim. İsteğe bağlı seçim.
                'optional_5'        => '',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'video', //video, resim ya da silder
                'optional_5'        => 'defaultFiles/video.mp4', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'picture', //video, resim ya da silder
                'optional_5'        => 'defaultFiles/image_background.jpg', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //video, resim ya da silder
                'optional_5'        => 'defaultFiles/slider/slider_1.jpg', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //video, resim ya da silder
                'optional_5'        => 'defaultFiles/slider/slider_2.jpg', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //video, resim ya da silder
                'optional_5'        => 'defaultFiles/slider/slider_3.jpg', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //meta etiketleri
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'meta',
                'value'             => '<meta charset="utf-8">',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'meta',
                'value'             => '<meta name="viewport" content="width=device-width, initial-scale=1">',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'meta',
                'value'             => '<meta name="description" content="Becki one page html5 template for business">',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'meta',
                'value'             => '<meta name="keywords" content="creative, fullscreen, business, photography, portfolio, one page, bootstrap responsive, start-up, ui/ux, html5, css3, studio, branding, creative design, multipurpose, parallax, personal, masonry, grid, coming soon, carousel, career">',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'meta',
                'value'             => '<meta http-equiv="X-UA-Compatible" content="IE=edge">',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
        ]);

        //admin_meta etiketleri
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'admin_meta',
                'value'             => '<meta name="author" content="Bünyamin Göymen">',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'admin_meta',
                'value'             => '<meta name="author2" content="bgoymen">',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
        ]);

        //faq
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'faq_questions',
                'value'             => 'Soru 1',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'faq_questions',
                'value'             => 'Soru 2',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
        ]);

        //Logo
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Icon',
                'optional_1'        => 'This logo is the logo that will appear on your home page',
                'optional_5'        => 'defaultFiles/logo/favicon.ico',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Home Logo White',
                'optional_1'        => 'This logo will appear at the top of the tab',
                'optional_5'        => 'defaultFiles/logo/logo-light.png',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Home Logo Dark',
                'optional_1'        => 'This logo is the logo that will appear on your home page',
                'optional_5'        => 'defaultFiles/logo/logo-dark.png',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Login Logo',
                'optional_1'        => 'This logo is the logo that will appear when members log in',
                'optional_5'        => 'defaultFiles/logo/logo-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Member Logo',
                'optional_1'        => 'This logo is the logo that will appear after members log in',
                'optional_5'        => 'defaultFiles/logo/logo-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Member Logo Small Light',
                'optional_1'        => 'This logo is the logo that will appear after members log in',
                'optional_5'        => 'defaultFiles/logo/logo-sm-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Admin Logo',
                'optional_1'        => 'This logo is the logo that appears on the admin page',
                'optional_5'        => 'defaultFiles/logo/logo-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Admin Login Logo',
                'optional_1'        => 'This logo is the logo that will appear after members log in',
                'optional_5'        => 'defaultFiles/logo/logo-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Admin Logo Small Light',
                'optional_1'        => '',
                'optional_5'        => 'defaultFiles/logo/logo-sm-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //Ödeme yöntemleri
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'payment_methods',
                'value'             => 'Money Order',
                'optional_1'        => '1', //seçili mi? değil mi?
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'payment_methods',
                'value'             => 'Credit Cart',
                'optional_1'        => '0', //seçili mi? değil mi?
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            /*
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'payment_methods',
                'value'             => 'Paypal',
                'optional_1'        => '1', //seçili mi? değil mi?
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            */
        ]);

        //Kategori Tipi
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'category_types',
                'value'             => 'Blog',
                'optional_1'        => 'blog',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'category_types',
                'value'             => 'Product',
                'optional_1'        => 'product',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'category_types',
                'value'             => 'Gallery',
                'optional_1'        => 'gallery',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //para tipi
        DB::table('key_values')->insert([
            [
                'code'              => 'TRY',
                'key'               => 'money_type',
                'value'             => 'TRY',
                'optional_1'        =>  '₺',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => 'USD',
                'key'               => 'money_type',
                'value'             => 'USD',
                'optional_1'        =>  '$',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => 'EUR',
                'key'               => 'money_type',
                'value'             => 'EUR',
                'optional_1'        =>  '€',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => 'STG',
                'key'               => 'money_type',
                'value'             => 'STG',
                'optional_1'        =>  '£',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //Süreçler
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'process_title',
                'value'             => 'Süreçlerimiz',
                'optional_1'        => '',
                'optional_2'        => '',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'processes',
                'value'             => 'Design',
                'optional_1'        => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Proin ut tempor nisl sit amet tincidunt orci.',
                'optional_2'        => 'icon-tools',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'processes',
                'value'             => 'Development',
                'optional_1'        => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Proin ut tempor nisl sit amet tincidunt orci.',
                'optional_2'        => 'icon-globe',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'processes',
                'value'             => 'Testing',
                'optional_1'        => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Proin ut tempor nisl sit amet tincidunt orci.',
                'optional_2'        => 'icon-mobile',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'processes',
                'value'             => 'Live',
                'optional_1'        => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Proin ut tempor nisl sit amet tincidunt orci.',
                'optional_2'        => 'icon-browser',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
        ]);

        //Servisşer
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'service_title',
                'value'             => 'What We Offer', // sub_title
                'optional_1'        => 'Our Services', //title
                'optional_2'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam semper ex ac velit varius semper. Mauris at dolor nec ante ultricies aliquam ac vitae diam. Quisque sodales vehicula elementum. Phasellus tempus tellus vitae ullamcorper hendrerit.',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'services',
                'value'             => 'Branding',
                'optional_1'        => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt.',
                'optional_2'        => 'icon-tools',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'services',
                'value'             => 'Marketing',
                'optional_1'        => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt.',
                'optional_2'        => 'icon-linegraph',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'services',
                'value'             => 'Development',
                'optional_1'        => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt.',
                'optional_2'        => 'icon-globe',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'services',
                'value'             => 'Web Design',
                'optional_1'        => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt.',
                'optional_2'        => 'icon-tools',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'services',
                'value'             => 'Social Media',
                'optional_1'        => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt.',
                'optional_2'        => 'icon-beaker',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'services',
                'value'             => 'Research',
                'optional_1'        => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt.',
                'optional_2'        => 'icon-layers',
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
        ]);

        //iletişim başlığı
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'contact_title',
                'value'             => 'Contact Us Now',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'contact_sub_title',
                'value'             => 'Just Keep In Touch',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //Adres
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'addresses',
                'value'             => 'Deneme Adresi İstanbul/Türkiye',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //Telefon numaraları
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'phones',
                'value'             => 'Landline',
                'optional_1'        => '+44 1234 567 9',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'phones',
                'value'             => 'Mobile',
                'optional_1'        => '+44 1234 567 9',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //E-mail adresleri
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'emails',
                'value'             => 'Order',
                'optional_1'        => 'order@yourwebsite.com',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'emails',
                'value'             => 'Request',
                'optional_1'        => 'request@yourwebsite.com',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //Sayfa tipi
        DB::table('key_values')->insert([
            [
                'code'              => 'gallery',
                'key'               => 'page_list_type',
                'value'             => '4',
                'optional_1'        => 'Gallery',
                'optional_2'        => 'Gallery Create / Edit',
                'optional_3'        => 'mdi mdi-note-outline',
                'optional_4'        => '1', //sidebarda göster
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => 'blog',
                'key'               => 'page_list_type',
                'value'             => '1',
                'optional_1'        => 'Blog',
                'optional_2'        => 'Blog Create / Edit',
                'optional_3'        => 'mdi mdi-note-outline',
                'optional_4'        => '1', //sidebarda göster
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => 'supplier',
                'key'               => 'page_list_type',
                'value'             => '3',
                'optional_1'        => 'Suppliers',
                'optional_2'        => 'Supplier Create / Edit',
                'optional_3'        => 'mdi mdi-truck-fast',
                'optional_4'        => '1', //sidebarda göster
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);
    }
}
