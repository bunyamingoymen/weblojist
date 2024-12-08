<?php

namespace App\Http\Controllers\Index\Themes;

use App\Http\Controllers\Controller;
use App\Models\Main\Files;
use App\Models\Main\KeyValue;
use App\Models\Main\Page;
use App\Models\Main\Product;

class BeckiController extends Controller
{
    public function index()
    {
        $backgroudSettings = KeyValue::Where('key', 'backgroudSettings')->first();
        if ($backgroudSettings) $backgroudSettings_type = $backgroudSettings->value;
        else $backgroudSettings_type = 'video';

        $backgrouds = KeyValue::Where('key', 'backgrouds')->where('value', $backgroudSettings_type)->where('delete', 0)->get();

        $site_title = KeyValue::Where('key', 'site_title')->first();
        $site_description = KeyValue::Where('key', 'site_description')->first();

        $home_pages = Page::Where('type', 2)->where('delete', 0)->Where('show_home', 1)->get();

        $process_title = KeyValue::Where('key', 'process_title')->first();
        $processes = KeyValue::Where('key', 'processes')->where('delete', 0)->get();

        $service_title = KeyValue::Where('key', 'service_title')->first();
        $services = KeyValue::Where('key', 'services')->where('delete', 0)->get();

        $supplier = Page::where('type', 3)
            ->where('show_home', 1)
            ->where('pages.delete', 0)
            ->leftJoin('key_values as supplier_url', function ($join) {
                $join->on('supplier_url.value', '=', 'pages.code')
                    ->where('supplier_url.key', '=', 'other_url_supplier');
            })
            ->leftJoin('key_values as different_page', function ($join) {
                $join->on('different_page.value', '=', 'pages.code')
                    ->where('different_page.key', '=', 'open_different_page');
            })
            ->select(
                'pages.*',
                'supplier_url.optional_1 as other_url_supplier',
                'different_page.optional_1 as open_different_page'
            )
            ->get();


        $blogs = Page::Where('type', 1)->where('show_home', 1)->where('delete', 0)->get();

        $address = KeyValue::Where('key', 'addresses')->first();
        $phones = KeyValue::Where('key', 'phones')->where('delete', 0)->get();
        $emails = KeyValue::Where('key', 'emails')->where('delete', 0)->get();

        $social_media = KeyValue::Where('key', 'social_media')->where('delete', 0)->get();

        $active_theme_path = getActiveThemePath();

        return view("{$active_theme_path}.index", compact(
            'backgroudSettings_type',
            'backgrouds',

            'site_title',
            'site_description',

            'home_pages',

            'process_title',
            'processes',

            'service_title',
            'services',

            'supplier',

            'blogs',

            'address',
            'phones',
            'emails',

            'social_media',
        ));
    }

    public function blogs()
    {
        $showblogCount = config('app.showblogCount') ?? 9;
        $blogs = Page::where('type', 1)
            ->where('delete', 0)
            ->where('active', 1)
            ->paginate($showblogCount);

        $type = 'blog';

        $active_theme_path = getActiveThemePath();

        return view("{$active_theme_path}.blogs", compact('blogs', 'type'));
    }

    public function blog_detail($pageCode)
    {
        $page = Page::Where('delete', 0)->Where('short_name', $pageCode)->first();
        if (!$page) abort('404');

        $type = 'blog';

        $show_title_on_its_own = KeyValue::Where('key', 'show_title_on_its_own')->Where('value', $page->code)->first();
        $show_date_on_its_own = KeyValue::Where('key', 'show_date_on_its_own')->Where('value', $page->code)->first();

        $files = Files::Where('type', 'page')->where('delete', 0)->where('type_code', $page->code)->get();

        $active_theme = getActiveTheme();
        return view("index.{$active_theme}.blog_detail", compact('page', 'type', 'show_title_on_its_own', 'show_date_on_its_own', 'files'));
    }

    public function products()
    {
        $blogs = Product::select(
            'products.id',
            'products.code',
            'products.title',
            'products.short_name',
            'products.description',
            'products.category',
            'products.price_without_vat',
            'products.priceType_without_vat',
            'products.price',
            'products.priceType',
            'products.cargo_company',
            'products.cargo_price',
            'products.cargo_priceType',
            'products.stock',
            'products.time',
            'products.can_be_deleted',
            'products.active',
            'products.delete',
            'products.create_user_code',
            'products.update_user_code',
            'products.created_at',
            'products.updated_at',
            'files.file'
        )
            ->leftJoin('files', function ($join) {
                $join->on('files.type_code', '=', 'products.code')
                    ->where('files.delete', '=', 0); // `files` tablosunda `delete` değeri 0 olanları al
            })
            ->groupBy(
                'products.id',
                'products.code',
                'products.title',
                'products.short_name',
                'products.description',
                'products.category',
                'products.price_without_vat',
                'products.priceType_without_vat',
                'products.price',
                'products.priceType',
                'products.cargo_company',
                'products.cargo_price',
                'products.cargo_priceType',
                'products.stock',
                'products.time',
                'products.can_be_deleted',
                'products.active',
                'products.delete',
                'products.create_user_code',
                'products.update_user_code',
                'products.created_at',
                'products.updated_at',
                'files.file'
            )
            ->where('products.delete', 0)
            ->paginate(config('app.showblogCount') ?? 9);

        $type = 'product';

        $active_theme = getActiveTheme();
        return view("index.{$active_theme}.blogs", compact('blogs', 'type'));
    }

    public function galleries()
    {
        $title = 'Gallery';
        $categories = KeyValue::Where('key', 'categories')->where('optional_1', 'Gallery')->get();

        $galleries = Page::select('pages.*', 'key_values.optional_1 as open_different_page')
            ->where('type', 4)
            ->leftJoin('key_values', function ($join) {
                $join->on('key_values.value', '=', 'pages.code')
                    ->where('key_values.key', '=', 'open_different_page');
            })
            ->where('pages.delete', 0)
            ->where('pages.active', 1)
            ->get();

        $active_theme = getActiveTheme();
        return view("index.{$active_theme}.gallery", compact('title', 'categories', 'galleries'));
    }


    public function product_detail($pageCode)
    {
        $page = Product::Where('delete', 0)->Where('short_name', $pageCode)->first();
        if (!$page) abort('404');

        $files = Files::Where('type', 'product')->where('delete', 0)->where('type_code', $page->code)->get();
        $type = 'product';

        $active_theme = getActiveTheme();
        return view("index.{$active_theme}.blog_detail", compact('page', 'type', 'files'));
    }

    public function contact()
    {
        $address = KeyValue::Where('key', 'addresses')->first();
        $phones = KeyValue::Where('key', 'phones')->where('delete', 0)->get();
        $emails = KeyValue::Where('key', 'emails')->where('delete', 0)->get();

        $social_media = KeyValue::Where('key', 'social_media')->where('delete', 0)->get();

        $active_theme = getActiveTheme();
        return view("index.{$active_theme}.contact", compact(

            'address',
            'phones',
            'emails',

            'social_media',
        ));
    }
}
