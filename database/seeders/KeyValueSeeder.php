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
                'value'             => 'Weblojist',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'site_description',
                'value'             => 'Websitenizi modern, kullanıcı dostu ve ihtiyaçlarınıza uygun şekilde tasarlıyor ve hayata geçiriyoruz. Ayrıca sosyal medya yönetimi, reklam planlaması ve marka ismi oluşturma hizmetleriyle markanızı dijital dünyada destekliyoruz. Hedefiniz, bizim önceliğimiz!',
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
                'optional_6'        => 'icon-facebook',
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
                'optional_6'        => 'icon-twitter',
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
                'optional_6'        => 'icon-instagram',
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
                'optional_6'        => 'icon-linkedin',
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
                'optional_6'        => 'icon-youtube',
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
                'optional_6'        => 'icon-pinterest',
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
                'optional_6'        => 'icon-whatsapp',
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
                'optional_6'        => 'icon-telegram',
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
                'optional_6'        => 'icon-discord',
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
                'optional_6'        => 'icon-website',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],

        ]);

        //Arkaplan tipleri
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgroudTypes',
                'value'             => 'video',
                'optional_1'        => 'Video',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgroudTypes',
                'value'             => 'slider',
                'optional_1'        => 'Slider',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgroudTypes',
                'value'             => 'picture',
                'optional_1'        => 'Picture',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgroudTypes',
                'value'             => 'creative',
                'optional_1'        => 'Creative',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgroudTypes',
                'value'             => 'slider',
                'optional_1'        => 'Slider',
                'optional_4'        => 'genz',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgroudTypes',
                'value'             => 'none',
                'optional_1'        => 'None',
                'optional_4'        => 'genz',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //Arkaplanlar (becki)
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgroudSettings',
                'value'             => 'creative', //picture, silder, resim ya da  creative. İsteğe bağlı seçim.
                'optional_4'        => 'becki',
                'optional_5'        => '',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'video', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/video.mp4', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'picture', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/image_background.jpg', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/slider/slider_1.jpg', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/slider/slider_2.jpg', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/slider/slider_3.jpg', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'creative', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/creative/creative_1.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'creative', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/creative/creative_2.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'creative', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/creative/creative_3.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'creative', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/creative/creative_4.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'creative', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/creative/creative_5.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'creative', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/creative/creative_6.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'creative', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/creative/creative_7.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'creative', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/creative/creative_8.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'creative', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/creative/creative_9.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'creative', //video, resim ya da silder
                'optional_4'        => 'becki',
                'optional_5'        => 'defaultFiles/creative/creative_10.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //Arkaplanlar (genz)
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgroudSettings',
                'value'             => 'slider', //picture, silder, resim ya da  creative. İsteğe bağlı seçim.
                'optional_1'        => null,
                'optional_2'        => null,
                'optional_3'        => null,
                'optional_4'        => 'genz',
                'optional_5'        => '',
                'optional_6'        => null,
                'optional_7'        => null,
                'optional_8'        => null,
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //slider
                'optional_1'        => '1', //konum (1,sırada , 2.sırada vs... max 5 adet var.)
                'optional_2'        => 'genz', //tema adı
                'optional_3'        => '/', //path
                'optional_4'        => '0', //farklı sayfada açılsın mı?
                'optional_5'        => 'defaultFiles/genz/slider/news1.png', //resim yolu (blog ya da sayfanın)
                'optional_6'        => 'I work best when my space is filled with inspiration',
                'optional_7'        => 'Gosh jaguar ostrich quail one excited dear hello and bound and the and bland moral misheard roadrunner flapped lynx far that and jeepers giggled far and far', //cover_letter
                'optional_8'        => '2022-04-25', //tarih
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //slider
                'optional_1'        => '2', //konum (1,sırada , 2.sırada vs... max 5 adet var.)
                'optional_2'        => 'genz', //tema adı
                'optional_3'        => '/', //path
                'optional_4'        => '0', //farklı sayfada açılsın mı?
                'optional_5'        => 'defaultFiles/genz/slider/img1.png', //resim yolu (blog ya da sayfanın)
                'optional_6'        => '10 States At Risk of Rural Hospital Closures',
                'optional_7'        => '', //cover_letter
                'optional_8'        => '2022-05-29', //tarih
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //slider
                'optional_1'        => '3', //konum (1,sırada , 2.sırada vs... max 5 adet var.)
                'optional_2'        => 'genz', //tema adı
                'optional_3'        => '/', //path
                'optional_4'        => '0', //farklı sayfada açılsın mı?
                'optional_5'        => 'defaultFiles/genz/slider/img2.png', //resim yolu (blog ya da sayfanın)
                'optional_6'        => 'U.S. Interventions in Latin America, in Photos',
                'optional_7'        => '', //cover_letter
                'optional_8'        => '2022-05-29', //tarih
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //slider
                'optional_1'        => '4', //konum (1,sırada , 2.sırada vs... max 5 adet var.)
                'optional_2'        => 'genz', //tema adı
                'optional_3'        => '/', //path
                'optional_4'        => '0', //farklı sayfada açılsın mı?
                'optional_5'        => 'defaultFiles/genz/slider/img3.png', //resim yolu (blog ya da sayfanın)
                'optional_6'        => '2019 Best Cars for the Money',
                'optional_7'        => '', //cover_letter
                'optional_8'        => '2022-05-29', //tarih
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'backgrouds',
                'value'             => 'slider', //slider
                'optional_1'        => '5', //konum (1,sırada , 2.sırada vs... max 5 adet var.)
                'optional_2'        => 'genz', //tema adı
                'optional_3'        => '/', //path
                'optional_4'        => '0', //farklı sayfada açılsın mı?
                'optional_5'        => 'defaultFiles/genz/slider/img4.png', //resim yolu (blog ya da sayfanın)
                'optional_6'        => 'How to View Breast Cancer Survival Rates',
                'optional_7'        => '', //cover_letter
                'optional_8'        => '2022-05-29', //tarih
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
                'optional_4'        => 'all',
                'optional_5'        => 'defaultFiles/logo/favicon.ico',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Home Logo White',
                'optional_1'        => 'This logo will appear at the top of the tab',
                'optional_4'        => 'all',
                'optional_5'        => 'defaultFiles/logo/logo-light.png',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Home Logo Dark',
                'optional_1'        => 'This logo is the logo that will appear on your home page',
                'optional_4'        => 'all',
                'optional_5'        => 'defaultFiles/logo/logo-dark.png',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Login Logo',
                'optional_1'        => 'This logo is the logo that will appear when members log in',
                'optional_4'        => 'all',
                'optional_5'        => 'defaultFiles/logo/logo-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Member Logo',
                'optional_1'        => 'This logo is the logo that will appear after members log in',
                'optional_4'        => 'all',
                'optional_5'        => 'defaultFiles/logo/logo-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Member Logo Small Light',
                'optional_1'        => 'This logo is the logo that will appear after members log in',
                'optional_4'        => 'all',
                'optional_5'        => 'defaultFiles/logo/logo-sm-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Admin Logo',
                'optional_1'        => 'This logo is the logo that appears on the admin page',
                'optional_4'        => 'all',
                'optional_5'        => 'defaultFiles/logo/logo-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Admin Login Logo',
                'optional_1'        => 'This logo is the logo that will appear after members log in',
                'optional_4'        => 'all',
                'optional_5'        => 'defaultFiles/logo/logo-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Admin Logo Small Light',
                'optional_1'        => '',
                'optional_4'        => 'all',
                'optional_5'        => 'defaultFiles/logo/logo-sm-light.png', //dosyanın yolu
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'logos',
                'value'             => 'Akea Menu Small',
                'optional_1'        => '',
                'optional_4'        => 'akea',
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
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'phones',
                'value'             => 'Mobile',
                'optional_1'        => '+44 1234 567 9',
                'can_be_deleted'    => 1,
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
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'emails',
                'value'             => 'Request',
                'optional_1'        => 'request@yourwebsite.com',
                'can_be_deleted'    => 1,
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

        //Tema ayarları
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'header_theme',
                'value'             => 'dark',
                'optional_4'        => 'becki', //hangi tmeya ait olduğunu belirtiyor.
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'sub_title_theme',
                'value'             => 'pink',
                'optional_4'        => 'becki', //hangi tmeya ait olduğunu belirtiyor.
                'can_be_deleted'    => 1,
                'delete'            => 0
            ],
        ]);

        //Galeri başlığı ve açıklama
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'gallery_title',
                'value'             => 'Galeri',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'gallery_description',
                'value'             => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam semper ex ac velit varius semper. Mauris at dolor nec ante ultricies aliquam ac vitae diam. Quisque sodales vehicula elementum. Phasellus tempus tellus vitae ullamcorper hendrerit.',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ]
        ]);

        //Sayfa Görünümleri
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'show_about',
                'value'             => '1',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'show_page',
                'value'             => '1',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'show_process',
                'value'             => '1',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'show_services',
                'value'             => '1',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'show_suppliers',
                'value'             => '1',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'show_contact',
                'value'             => '1',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'show_whatsapp',
                'value'             => '0',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'show_user_login',
                'value'             => '0',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'show_page_titles',
                'value'             => '0',
                'optional_4'        => 'becki',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);

        //Temalar
        DB::table('key_values')->insert([
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'active_theme',
                'value'             => 'becki',
                'optional_1'        => 'index.becki',
                'optional_2'        => '',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'themes',
                'value'             => 'becki', //tema kodu
                'optional_1'        => 'index.becki',  //tema yolu
                'optional_2'        => 'Becki', //Tema görünür ismi
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'themes',
                'value'             => 'akea',
                'optional_1'        => 'index.akea',
                'optional_2'        => 'Akea',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'themes',
                'value'             => 'bizblog',
                'optional_1'        => 'index.bizblog',
                'optional_2'        => 'Bizblog',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
            [
                'code'              => $mainController->generateUniqueCode(['table' => 'key_values']),
                'key'               => 'themes',
                'value'             => 'genz',
                'optional_1'        => 'index.genz',
                'optional_2'        => 'Genz',
                'can_be_deleted'    => 0,
                'delete'            => 0
            ],
        ]);
    }
}
