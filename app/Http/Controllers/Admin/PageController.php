<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Main\Files;
use App\Models\Main\KeyValue;
use App\Models\Main\Page;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Prompts\Key;

class PageController extends Controller
{
    protected $mainController;

    public function __construct()
    {
        $this->mainController = new MainController();
    }

    public function listPage(Request $request)
    {
        $params = $request->route('params');
        if (!$params) return redirect()->back('admin_page');

        $configs = config('config.admin.' . str_replace("/", ".", $params));
        if (!$configs) return redirect()->back('admin_page');

        $type = $configs['view']['pageType'] ?? 2;
        $title = $configs['title'];

        return view($configs['view']['page'], compact('type', 'title', 'params'));
    }

    public function editPage(Request $request)
    {
        $params = $request->route('params');
        $configs = config('config.admin.' . str_replace("/", ".", $request->params));
        $category_type = KeyValue::Where('key', 'category_types')->where('optional_1', explode("/", $params)[0])->first();
        if ($category_type) {
            $categories = KeyValue::Where('key', 'categories')->where('optional_1', $category_type->value)->get();
        } else $categories = null;
        if ($configs['view']['pageType']) $type = $configs['view']['pageType'];
        else $type = 2;

        if ($request->code) $item = $this->mainController->databaseOperations(['model' => 'App\Models\Main\Page', 'returnvalues' => ['item'], 'where' => ['code' => $request->code], 'create' => false])['item'] ?? null;
        else $item = null;

        $language = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => 'language'], 'create' => false])['items'] ?? [];

        $title = $configs['title'];

        if ($item) {
            $other_url_supplier = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['item'], 'where' => ['key' => 'other_url_supplier', 'value' => $item->code], 'create' => false])['item'] ?? null;
            $show_title_on_its_own = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['item'], 'where' => ['key' => 'show_title_on_its_own', 'value' => $item->code], 'create' => false])['item'] ?? null;
            $show_date_on_its_own = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['item'], 'where' => ['key' => 'show_date_on_its_own', 'value' => $item->code], 'create' => false])['item'] ?? null;
            $show_author_on_its_own = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['item'], 'where' => ['key' => 'show_author_on_its_own', 'value' => $item->code], 'create' => false])['item'] ?? null;
            $open_different_page = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['item'], 'where' => ['key' => 'open_different_page', 'value' => $item->code], 'create' => false])['item'] ?? null;
            $files = $this->mainController->databaseOperations(['model' => 'App\Models\Main\Files', 'returnvalues' => ['items'], 'where' => ['type' => 'page', 'type_code' => $request->code], 'create' => false])['items'] ?? null;
        } else {
            $other_url_supplier = null;
            $show_title_on_its_own = null;
            $show_date_on_its_own = null;
            $open_different_page = null;
            $files = null;
            $show_author_on_its_own = null;
        }

        return view('admin.data.page.edit', compact(
            'item',
            'params',
            'language',
            'title',
            'type',
            'other_url_supplier',
            'show_title_on_its_own',
            'show_date_on_its_own',
            'show_author_on_its_own',
            'open_different_page',
            'files',
            'categories'
        ));
    }

    public function edit(Request $request)
    {
        $data = $this->mainController->databaseOperations(['model' => 'App\Models\Main\Page', 'returnvalues' => ['item'], 'where' => ['code' => $request->code ?? -1, 'type' => $request->type ?? 2], 'create' => true]);
        $item = Page::where('code', $data['item']->code)->first();
        $isNew = $data['isNew'] ?? false;

        $language = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => 'language'], 'create' => false])['items'] ?? [];

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

            if ($request->sub_title && isset($request->language[$lan->optional_1]['sub_title'])) {
                $translationSubTitle = $this->mainController->databaseOperations(['model' => 'App\Models\Translation', 'returnvalues' => ['item'], 'where' => ['key' => $request->sub_title, 'language' => $lan->optional_1], 'create' => false])['item'] ?? null;

                if ($translationSubTitle)
                    $translationSubTitle = Translation::find($translationTitle->id);
                else
                    $translationSubTitle = new Translation();

                $translationSubTitle->key = $request->title;
                $translationSubTitle->language = $lan->optional_1;
                $translationSubTitle->value = $request->language[$lan->optional_1]['sub_title'];
                $translationSubTitle->type = -1;
                $translationSubTitle->save();
            }

            if ($request->description && isset($request->language[$lan->optional_1]['description'])) {
                $translationDescription = $this->mainController->databaseOperations(['model' => 'App\Models\Translation', 'returnvalues' => ['item'], 'where' => ['key' => $request->description, 'language' => $lan->optional_1], 'create' => false])['item'] ?? null;

                if ($translationDescription)
                    $translationDescription = Translation::find($translationDescription->id);
                else
                    $translationDescription = new Translation();

                $translationDescription->key = $request->description;
                $translationDescription->language = $lan->optional_1;
                $translationDescription->value = $request->language[$lan->optional_1]['description'];
                $translationDescription->type = -1;
                $translationDescription->save();
            }
        }

        if (!$request->type) $type = 2;
        else $type = $request->type;

        $item->title = $request->title;
        $item->sub_title = $request->sub_title;
        $item->short_name = $item->can_be_deleted == 1 ? $this->mainController->makeUrl($request->title) : $item->short_name;
        $item->description = $request->description;
        $item->category = $request->category;
        $item->type = $type;

        if ($request->hasFile('image')) {
            $file = $request->file("image");
            $main_path = "file/page/{$item->type}";
            $path = public_path($main_path);
            $name = "{$item->type}_{$item->code}_{$this->mainController->generateUniqueCode(['length' => 5])}.{$file->getClientOriginalExtension()}";
            $file->move($path, $name);
            $item->image = "{$main_path}/{$name}";
        }

        $item->show_home = $request->show_home ? 1 : 0;
        $item->home_type = $request->home_type ? 1 : 0;

        if (!$isNew) $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        KeyValue::Where('key', 'show_title_on_its_own')->Where('value', $item->code)->delete();
        if ($request->show_title_on_its_own) {
            $show_title_on_its_own = new KeyValue();
            $show_title_on_its_own->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
            $show_title_on_its_own->key = 'show_title_on_its_own';
            $show_title_on_its_own->value = $item->code;
            $show_title_on_its_own->optional_1 = $request->show_title_on_its_own ? '1' : '0';
            $show_title_on_its_own->create_user_code = Auth::guard('admin')->user()->code;
            $show_title_on_its_own->update_user_code = Auth::guard('admin')->user()->code;
            $show_title_on_its_own->save();
        }

        KeyValue::Where('key', 'show_date_on_its_own')->Where('value', $item->code)->delete();
        if ($request->show_date_on_its_own) {
            $show_date_on_its_own = new KeyValue();
            $show_date_on_its_own->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
            $show_date_on_its_own->key = 'show_date_on_its_own';
            $show_date_on_its_own->value = $item->code;
            $show_date_on_its_own->optional_1 = $request->show_date_on_its_own;
            $show_date_on_its_own->create_user_code = Auth::guard('admin')->user()->code;
            $show_date_on_its_own->update_user_code = Auth::guard('admin')->user()->code;
            $show_date_on_its_own->save();
        }

        KeyValue::Where('key', 'show_author_on_its_own')->Where('value', $item->code)->delete();
        if ($request->show_author_on_its_own) {
            $show_author_on_its_own = new KeyValue();
            $show_author_on_its_own->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
            $show_author_on_its_own->key = 'show_author_on_its_own';
            $show_author_on_its_own->value = $item->code;
            $show_author_on_its_own->optional_1 = $request->show_author_on_its_own;
            $show_author_on_its_own->create_user_code = Auth::guard('admin')->user()->code;
            $show_author_on_its_own->update_user_code = Auth::guard('admin')->user()->code;
            $show_author_on_its_own->save();
        }

        KeyValue::Where('key', 'open_different_page')->Where('value', $item->code)->delete();
        if ($request->open_different_page) {
            $open_different_page = new KeyValue();
            $open_different_page->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
            $open_different_page->key = 'open_different_page';
            $open_different_page->value = $item->code;
            $open_different_page->optional_1 = $request->open_different_page ? '1' : '0';
            $open_different_page->create_user_code = Auth::guard('admin')->user()->code;
            $open_different_page->update_user_code = Auth::guard('admin')->user()->code;
            $open_different_page->save();
        }

        KeyValue::Where('key', 'other_url_supplier')->Where('value', $item->code)->delete();
        if ($request->other_url_supplier) {
            $other_url_supplier = new KeyValue();
            $other_url_supplier->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
            $other_url_supplier->key = 'other_url_supplier';
            $other_url_supplier->value = $item->code;
            $other_url_supplier->optional_1 = $request->other_url_supplier;
            $other_url_supplier->create_user_code = Auth::guard('admin')->user()->code;
            $other_url_supplier->update_user_code = Auth::guard('admin')->user()->code;
            $other_url_supplier->save();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $main_path = 'files/page/images';
                $path = public_path($main_path);
                $name = $item->code . "_image_" . $this->mainController->generateUniqueCode(['length' => 5]) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $name);

                $page_multi = new Files();
                $page_multi->code = $this->mainController->generateUniqueCode(['table' => 'files']);
                $page_multi->type = 'page';
                $page_multi->type_code = $item->code;
                $page_multi->file = $main_path . "/" . $name;
                $page_multi->file_type = 'img';
                $page_multi->create_user_code = Auth::guard('admin')->user()->code;
                $page_multi->update_user_code = Auth::guard('admin')->user()->code;
                $page_multi->save();
            }
        }

        return redirect()->route('admin_page', ['params' => $request->post['redirect']['params']])->with('success', $isNew ? 'Created' : 'Updated');
    }

    public function delete(Request $request)
    {
        $item = Page::Where('code', $request->code)->first();
        if (!$item) return redirect()->back()->with('error', 'An error occurred (Page)');

        if ($item->can_be_deleted == 0) return redirect()->back()->with('error', 'This value cannot be deleted');

        $item->delete = 1;
        $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        $configs = config('config.admin.' . str_replace("/", ".", $request->params));

        return redirect()->route('admin_page', ['params' => $configs['view']['redirect']['params']])->with('success', 'Deleted');
    }

    public function deleteImage(Request $request)
    {
        $item = Files::Where('code', $request->code)->first();
        if (!$item) return redirect()->back()->with('error', 'An error occurred (Product Image)');

        if ($item->can_be_deleted == 0) return redirect()->back()->with('error', 'This value cannot be deleted');

        $item->delete = 1;
        $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        return redirect()->back()->with('success', 'Deleted');
    }

    public function getData(Request $request)
    {
        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];


        if ($request->search) {
            $search = [
                'search' => $request->search,
                'dbSearch' => ['title', 'description']
            ];
        } else $search = [];

        $result = $this->mainController->databaseOperations(['model' => 'App\Models\Main\Page', 'pagination' => $pagination, 'search' => $search, 'returnvalues' => ['items', 'pageCount'], 'where' => ['type' => $request->type], 'create' => false]);

        return $result;
    }
}
