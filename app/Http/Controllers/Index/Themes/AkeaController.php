<?php

namespace App\Http\Controllers\Index\Themes;

use App\Http\Controllers\Controller;
use App\Models\Main\Files;
use App\Models\Main\KeyValue;
use App\Models\Main\Page;
use App\Models\Main\Product;

class AkeaController extends Controller
{
    public function index() {}

    public function blogs() {}

    public function blog_detail($pageCode) {}

    public function contact()
    {

        $social_media = KeyValue::Where('key', 'social_media')->where('delete', 0)->get();

        $active_theme = getActiveTheme();
        return view("index.{$active_theme}.contact", compact(
            'social_media',
        ));
    }
}
