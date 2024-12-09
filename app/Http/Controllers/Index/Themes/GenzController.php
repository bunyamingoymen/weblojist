<?php

namespace App\Http\Controllers\Index\Themes;

use App\Http\Controllers\Controller;
use App\Models\Main\KeyValue;
use App\Models\Main\Page;
use Illuminate\Http\Request;

class GenzController extends Controller
{
    public function index()
    {
        $active_theme = getActiveTheme();

        $backgroudSettings = KeyValue::Where('key', 'backgroudSettings')->where('optional_4', $active_theme)->first();
        $backgrouds = KeyValue::Where('key', 'backgrouds')->where('value', $backgroudSettings->value ?? 'slider')->where('optional_2', $active_theme)->orderBy('optional_1', 'ASC')->get();

        $blogs = Page::Where('type', 1)->where('delete', 0)->limit(config('app.showblogCount') ?? 15)->orderBy('pinned', 'DESC')->orderBy('created_at', 'DESC')->get();

        $active_theme_path = getActiveThemePath();

        return view("{$active_theme_path}.index", compact('backgroudSettings', 'backgrouds', 'blogs'));
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
