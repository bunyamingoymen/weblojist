<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Main\KeyValue;
use App\Models\Main\Menu;
use App\Models\Main\Page;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    protected $mainController;

    public function __construct()
    {
        $this->mainController = new MainController();
    }

    public function menuIndex(Request $request)
    {
        if ($request->page == 'admin.setting.menu.footer') $menu_type = 'footer';
        else $menu_type = 'header';

        $selected_menu = Menu::Where('delete', 0)->where('type', $menu_type)->where('code', $request->code)->first();
        if (!$selected_menu) {
            $selected_menu = null;
        }
        $menu = Menu::Where('delete', 0)->where('type', $menu_type)->orderBy('row', 'ASC')->get();

        $blogs = Page::Where('delete', 0)->where('type', 1)->get();
        $pages = Page::Where('delete', 0)->where('type', 2)->get();
        $suppliers = Page::Where('delete', 0)->where('type', 3)->get();

        if ($menu_type == 'footer') $footer_title = KeyValue::Where('key', 'footer_titles')->get();
        else $footer_title = null;


        $title = $request->title;

        $language = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => 'language'], 'create' => false])['items'] ?? [];

        return view($request->page, compact(
            'title',

            'language',

            'selected_menu',
            'menu',

            'blogs',
            'pages',
            'suppliers',

            'footer_title'
        ));
    }

    public function menuEdit(Request $request)
    {

        $is_new = false;
        $menu = Menu::Where('delete', 0)->where('code', $request->code)->first();
        if (!$menu) {
            $menu = new Menu();
            $menu->code = $this->mainController->generateUniqueCode(['table' => 'menus']);
            $menu->type = $request->type;
            $is_new = true;
        }

        $language = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => 'language'], 'create' => false])['items'] ?? [];

        $menu->top_category = $request->top_category;
        $menu->title = $request->title;

        if (!$request->footer_type || ($request->footer_type && $request->footer_type == 'url')) {
            foreach ($language as $lan) {
                if (!isset($request->language) || !isset($request->language[$lan->optional_1])) continue;

                if ($request->title && isset($request->language[$lan->optional_1]['title'])) {
                    $translationTitle = $this->mainController->databaseOperations(['model' => 'App\Models\Translation', 'returnvalues' => ['item'], 'where' => ['key' => $request->title, 'language' => $lan->optional_1], 'create' => false])['item'] ?? null;

                    if ($translationTitle)
                        $translationTitle = Translation::find($translationTitle->id);
                    else
                        $translationTitle = new Translation();

                    $translationTitle->key = $request->title;
                    $translationTitle->language = $lan->optional_1;
                    $translationTitle->value = $request->language[$lan->optional_1]['title'];
                    $translationTitle->type = -1;
                    $translationTitle->save();
                }
            }

            //menu path belirleme kısmı
            if ($request->path == 'specific_page')
                $menu->path = $request->specific_selectbox_page;
            else if ($request->path == 'specific_blog')
                $menu->path = $request->specific_selectbox_blog;
            else if ($request->path == 'specific_supplier')
                $menu->path = $request->specific_selectbox_supplier;
            else if ($request->path == 'manuel_input')
                $menu->path = $request->manuel_input;
            else
                $menu->path = $request->path;
        } else if ($request->footer_type && $request->footer_type == 'image') {

            if ($request->hasFile('footer_type_image_light')) {
                $file = $request->file("footer_type_image_light");
                $main_path = "file/footer/image";
                $path = public_path($main_path);
                $name = "footer_image_light_{$menu->code}_{$this->mainController->generateUniqueCode(['length' => 5])}.{$file->getClientOriginalExtension()}";
                $file->move($path, $name);
                $menu->title = "{$main_path}/{$name}";
            } else $menu->title = $menu->path ?? '';

            if ($request->hasFile('footer_type_image_dark')) {
                $file = $request->file("footer_type_image_dark");
                $main_path = "file/footer/image";
                $path = public_path($main_path);
                $name = "footer_image_dark_{$menu->code}_{$this->mainController->generateUniqueCode(['length' => 5])}.{$file->getClientOriginalExtension()}";
                $file->move($path, $name);
                $menu->path = "{$main_path}/{$name}";
            } else $menu->path = $menu->path ?? '';
        } else if ($request->footer_type && $request->footer_type == 'text') {
            foreach ($language as $lan) {
                if (!isset($request->language) || !isset($request->language[$lan->optional_1])) continue;

                if ($request->title && isset($request->language[$lan->optional_1]['footer_type_text'])) {
                    $translationTitle = $this->mainController->databaseOperations(['model' => 'App\Models\Translation', 'returnvalues' => ['item'], 'where' => ['key' => $request->footer_type_text, 'language' => $lan->optional_1], 'create' => false])['item'] ?? null;

                    if ($translationTitle)
                        $translationTitle = Translation::find($translationTitle->id);
                    else
                        $translationTitle = new Translation();

                    $translationTitle->key = $request->title;
                    $translationTitle->language = $lan->optional_1;
                    $translationTitle->value = $request->language[$lan->optional_1]['footer_type_text'];
                    $translationTitle->type = -1;
                    $translationTitle->save();
                }
            }

            $menu->path = $request->footer_type_text ?? '';
        } else if ($request->footer_type && $request->footer_type == 'social_media') {
            $menu->path = '';
        } else if ($request->footer_type && $request->footer_type == 'title') {
            $menu->path = $request->footer_type_title;
        } else {
            $menu->path = '';
        }


        $menu->footer_type = $request->footer_type;
        $menu->row = $request->row;
        $menu->column = $request->column;
        $menu->active = $request->active ? '1' : '0';
        $menu->open_different_page = $request->open_different_page ? 1 : 0;

        if ($is_new) $menu->create_user_code = Auth::guard('admin')->user()->code;
        else $menu->update_user_code = Auth::guard('admin')->user()->code;
        $menu->save();

        return redirect()->route('admin_page', ['params' => $request->post['redirect']['params']])->with('success', $is_new ? 'Created' : 'Updated');
    }

    public function menuDelete(Request $request)
    {
        $item = Menu::Where('code', $request->code)->first();
        if (!$item) return redirect()->back()->with('error', 'An error occurred');

        if ($item->can_be_deleted == 0) return redirect()->back()->with('error', 'This value cannot be deleted');

        $item->delete = 1;
        $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        $configs = config('config.admin.' . str_replace("/", ".", $request->params));

        return redirect()->route('admin_page', ['params' => $configs['view']['redirect']['params']])->with('success', 'Deleted');
    }
}
