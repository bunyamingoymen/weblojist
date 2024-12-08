<?php

namespace App\Http\Controllers\Index\Themes;

use App\Http\Controllers\Controller;
use App\Models\Main\KeyValue;
use Illuminate\Http\Request;

class GenzController extends Controller
{
    public function index()
    {
        dd('GenzController.index');
    }

    public function blogs()
    {
        dd('GenzController.blogs');
    }

    public function blog_detail($pageCode)
    {
        dd('GenzController.blog_detail');
    }

    public function contact()
    {

        $social_media = KeyValue::Where('key', 'social_media')->where('delete', 0)->get();

        $active_theme = getActiveTheme();
        return view("index.{$active_theme}.contact", compact(
            'social_media',
        ));
    }
}
