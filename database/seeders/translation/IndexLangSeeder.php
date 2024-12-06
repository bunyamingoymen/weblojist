<?php

namespace Database\Seeders\translation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndexLangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $indexTexts = [
            'Home' => [
                'tr' => 'Anasayfa',
                'en' => 'Home',
            ],
            'Products' => [
                'tr' => 'Ürünler',
                'en' => 'Products',
            ],
            'Services' => [
                'tr' => 'Servislerimiz',
                'en' => 'Services',
            ],
            'About' => [
                'tr' => 'Hakkımızda',
                'en' => 'About',
            ],
            'Contact' => [
                'tr' => 'İletişim',
                'en' => 'Contact',
            ],
            'Suppliers' => [
                'tr' => 'Tedarikçiler',
                'en' => 'Suppliers',
            ],

            'About Us' => [
                'tr' => 'Hakkımızda',
                'en' => 'About Us',
            ],

            'Who We Are' => [
                'tr' => 'Biz Kimiz?',
                'en' => 'Who We Are?'
            ],
            'Address' => [
                'tr' => 'Adres',
                'en' => 'Address'
            ],
            'Office Numbers' => [
                'tr' => 'Ofis Numaraları',
                'en' => 'Office Numbers'
            ],
            'Our E-mail' => [
                'tr' => 'E-Mail Adreslerimiz',
                'en' => 'Our E-mail'
            ],

            'Name' => [
                'tr' => 'İsim',
                'en' => 'Name'
            ],
            'E-Mail' => [
                'tr' => 'E-Mail',
                'en' => 'E-Mail'
            ],
            'Subject' => [
                'tr' => 'Konu',
                'en' => 'Subject'
            ],
            'Message' => [
                'tr' => 'Mesaj',
                'en' => 'Message'
            ],

            'Please Enter Your Name' => [
                'tr' => 'Lütfen İsminizi Giriniz',
                'en' => 'Please Enter Your Name'
            ],

            'Please Enter Your E-mail Address' => [
                'tr' => 'Lütfen E-mail Adresinizi Giriniz',
                'en' => 'Please Enter Your E-mail Address'
            ],

            'Please Enter Your Message' => [
                'tr' => 'Lütfen Mesajınızı Giriniz',
                'en' => 'Please Enter Your Message'
            ],

            'Send Message' => [
                'tr' => 'Mesajı Gönder',
                'en' => 'Send Message'
            ],

            'Your message has been sent' => [
                'tr' => 'Mesajınız gönderildi',
                'en' => 'Your message has been sent'
            ],
            'Blog' => [
                'tr' => 'Blog',
                'en' => 'Blog'
            ],
            'Page' => [
                'tr' => 'Sayfa',
                'en' => 'Page'
            ],

            'Read More' => [
                'tr' => 'Daha Fazla',
                'en' => 'Read More'
            ],

            'PAGE' => [
                'tr' => 'SAYFA',
                'en' => 'PAGE'
            ],

            'ERROR!' => [
                'tr' => 'BULUNAMADI!',
                'en' => 'ERROR!'
            ],

            "THE PAGE YOU ARE LOOKING FOR DOESN'T EXIST." => [
                'tr' => 'ARADIĞINIZ SAYFA BULUNAMIYOR.',
                'en' => "THE PAGE YOU ARE LOOKING FOR DOESN'T EXIST."
            ],

            'BACK TO HOME' => [
                'tr' => 'ANASAYFAYA DÖN',
                'en' => 'BACK TO HOME'
            ],

            'Supplier' => [
                'tr' => 'Tedarikçi',
                'en' => 'Supplier'
            ],
            'Just Keep In Touch' => [
                'tr' => 'Bizimle İletişime Geçin',
                'en' => 'Just Keep In Touch'
            ],
            'Contact Us Now' => [
                'tr' => 'Şimdi İletişime Geçin',
                'en' => 'Contact Us Now'
            ],

            'Gallery' => [
                'tr' => 'Galeri',
                'en' => 'Gallery'
            ],

            'All' => [
                'tr' => 'Tümü',
                'en' => 'All'
            ],

            'Details' => [
                'tr' => 'Detaylar',
                'en' => 'Details'
            ],

        ];

        $commonValues = [
            'type' => 1,
        ];

        // Her bir metin (key) ve dillerdeki karşılıkları döngü ile oluştur
        foreach ($indexTexts as $key => $languages) {
            foreach ($languages as $lang => $value) {
                $finalData[] = array_merge($commonValues, [
                    'key' => $key,
                    'language' => $lang,
                    'value' => $value
                ]);
            }
        }

        // Veritabanına ekleme
        DB::table('translations')->insert($finalData);
    }
}
