<?php

namespace App\Http\Controllers\Index\Themes;

use App\Http\Controllers\Controller;
use App\Models\Main\Files;
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
        $showblogCount = config('app.showblogCount') ?? 15;

        $blogs = Page::join('admin_users', 'admin_users.code', '=', 'pages.create_user_code')
            ->where('pages.type', 1)
            ->where('pages.delete', 0)
            ->where('pages.active', 1)
            ->orderBy('pages.pinned', 'DESC')
            ->orderBy('pages.created_at', 'DESC')
            ->select('pages.*', 'admin_users.name as admin_name', 'admin_users.image as admin_image')
            ->paginate($showblogCount);

        $type = 'blog';

        $active_theme_path = getActiveThemePath();

        return view("{$active_theme_path}.blogs", compact('blogs', 'type'));
    }

    public function blog_detail($pageCode)
    {
        $page = Page::join('admin_users', 'admin_users.code', '=', 'pages.create_user_code')
            ->where('pages.delete', 0)
            ->where('pages.active', 1)
            ->Where('pages.short_name', $pageCode)
            ->select('pages.*', 'admin_users.name as admin_name', 'admin_users.image as admin_image')
            ->first();

        if (!$page) abort('404');

        $show_title_on_its_own = KeyValue::Where('key', 'show_title_on_its_own')->Where('value', $page->code)->first();
        $show_date_on_its_own = KeyValue::Where('key', 'show_date_on_its_own')->Where('value', $page->code)->first();
        $show_author_on_its_own = KeyValue::Where('key', 'show_author_on_its_own')->Where('value', $page->code)->first();

        $files = Files::Where('type', 'page')->where('delete', 0)->where('type_code', $page->code)->get();

        $active_theme = getActiveTheme();
        return view("index.{$active_theme}.blog_detail", compact('page', 'show_title_on_its_own', 'show_date_on_its_own', 'show_author_on_its_own', 'files'));
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
