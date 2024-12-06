<?php

namespace App\Providers;

use App\Models\Main\Cart;
use App\Models\Main\KeyValue;
use App\Models\Main\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $adminPages = ['admin.layouts.main'];
        $indexPages = ['index.layous.main', 'index.index', 'index.blogs', 'index.blog_detail'];
        $userPages = ['user.layouts.main'];

        View::composer($adminPages, function ($view) {
            $config_parameters = config('config.admin');
            $using_values =  config('config.using_values');

            $sidebars = $this->findValidKeysWithSidebar($config_parameters, $using_values, 'admin');
            $menus = config('config.menu');
            $sidebarHTML = [];
            $menuCount = [];
            foreach ($menus as $key => $menu) {
                $sidebarHTML[$key] = "<li class=\"menu-title\">" . lang_db($menu['title']) . "</li>";
                $menuCount[$key] = 0;
            }

            $id = "sidebarDashboard";
            $link = route('admin_page');
            $icon = config('config.admin.sidebar.icon') ?? '';
            $title =  config('config.admin.sidebar.title') ? lang_db(config('config.admin.sidebar.title')) : '';

            $sidebarHTML[config('config.admin.sidebar.group')] .= "
                    <li id=\"{$id}\">
                        <a href=\"{$link}\" class=\"waves-effect\">
                            <i class=\"{$icon}\"></i>
                            <span>{$title}</span>
                        </a>
                    </li>
                    ";
            $menuCount[config('config.admin.sidebar.group')] = 1;

            foreach ($sidebars as $sidebar) {
                try {

                    $type = config('config.' . $sidebar . '.sidebar.type') ?? 'single';
                    $icon = config('config.' . $sidebar . '.sidebar.icon') ?? '';
                    $title = config('config.' . $sidebar . '.sidebar.title') ? lang_db(config('config.' . $sidebar . '.sidebar.title')) : '';
                    $group = config('config.' . $sidebar . '.sidebar.group') ?? '';
                    $link = str_replace('admin.', '', $sidebar);
                    $link = route('admin_page', ['params' => str_replace('.', '/', $link)]);
                    $id = config('config.' . $sidebar . '.sidebar.id') ?? '';
                    $top_id = config('config.' . $sidebar . '.sidebar.top_id') ?? '';

                    if ($type == 'single') {
                        $sidebarHTML[$group] .= "
                        <li id=\"{$id}\">
                            <a href=\"{$link}\" class=\"waves-effect\">
                                <i class=\"{$icon}\"></i>
                                <span>{$title}</span>
                            </a>
                        </li>
                        ";
                    } elseif ($type == 'multi') {
                        $show_this = config('config.' . $sidebar . '.sidebar.show_this') ?? true;
                        $sidebarHTML[$group] .= "
                        <li id=\"{$id}\">
                            <a href=\"javascript:void(0);\" class=\"has-arrow waves-effect\">
                                <i class=\"{$icon}\"></i>
                                <span>{$title}</span>
                            </a>
                            <ul id=\"\" class=\"sub-menu\" aria-expanded=\"false\">
                        ";
                        if ($show_this) {
                            $sidebarHTML[$group] .= "
                                <li><a href=\"{$link}\">{$title}</a></li>
                                ";
                        }

                        $sidebarHTML[$group] .= " <span hidden class=\"span_hidden_sub_menu\">(_{$id}_SUB_)</span>
                                </ul>
                            </li>";
                    } elseif ($type == 'multi_alt') {
                        $sidebarAltHTML = "
                        <li><a href=\"{$link}\">{$title}</a></li>
                        <span hidden class=\"span_hidden_sub_menu\">(_{$top_id}_SUB_)</span>
                        ";
                        $sidebarHTML[$group] = str_replace("<span hidden class=\"span_hidden_sub_menu\">(_{$top_id}_SUB_)</span>", $sidebarAltHTML, $sidebarHTML[$group]);
                    }
                } catch (\Throwable $th) {
                    continue;
                }


                $menuCount[$group] += 1;
            }

            foreach ($menus as $key => $menu) {
                if ($menuCount[$key] < 1) $sidebarHTML[$key] = str_replace("<li class=\"menu-title\">" . lang_db($menu['title']) . "</li>", '', $sidebarHTML[$key]);
            }

            $main_flag = KeyValue::Where('key', 'language')->Where('optional_1', getActiveLang())->first();
            if ($main_flag) $main_flag = $main_flag->optional_5;
            else $main_flag = "-1";

            $other_flags = KeyValue::Where('key', 'language')->Where('optional_1', '!=', getActiveLang())->get();

            $view->with(["sidebarHTML" => $sidebarHTML, "main_flag" => $main_flag, "other_flags" => $other_flags]);
        });

        View::composer($indexPages, function ($view) {
            $main_flag = KeyValue::Where('key', 'language')->Where('optional_1', getActiveLang())->first();
            if ($main_flag) $main_flag = $main_flag->optional_5;
            else $main_flag = "-1";

            $other_flags = KeyValue::Where('key', 'language')->get();


            $view->with(compact('main_flag', 'other_flags'));
        });

        View::composer($userPages, function ($view) {
            $main_flag = KeyValue::Where('key', 'language')->Where('optional_1', getActiveLang())->first();
            if ($main_flag) $main_flag = $main_flag->optional_5;
            else $main_flag = "-1";

            $other_flags = KeyValue::Where('key', 'language')->Where('optional_1', '!=', getActiveLang())->get();

            if (Auth::user()) $cart_count = Cart::Where('user_code', Auth::user()->code)->count() ?? 0;
            else $cart_count = 0;

            $view->with(compact('main_flag', 'other_flags', 'cart_count'));
        });
    }

    protected function findValidKeysWithSidebar($array, $bannedKeys, $currentPath = '')
    {
        $validPaths = [];

        foreach ($array as $key => $value) {
            // Eğer yasaklı bir key ise, devam et
            if (in_array($key, $bannedKeys)) {
                continue;
            }

            // Yeni path oluştur
            $newPath = $currentPath === '' ? $key : $currentPath . '.' . $key;

            // Eğer değer bir dizi ise ve "sidebar" ve "show" içeriyorsa kontrol et
            if (is_array($value)) {
                if (isset($value['sidebar']) && isset($value['sidebar']['show']) && $value['sidebar']['show'] === true) {
                    if (checkAuth(['params' => $newPath])['status']) $validPaths[] = $newPath;  // İstenilen anahtar bulundu, path'i kaydet
                }

                // Diziyi tekrar işle (recursion)
                $validPaths = array_merge($validPaths, $this->findValidKeysWithSidebar($value, $bannedKeys, $newPath));
            }
        }

        return $validPaths;
    }
}
