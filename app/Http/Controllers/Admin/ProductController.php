<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Main\Files;
use App\Models\Main\Product;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    protected $mainController;

    public function __construct()
    {
        $this->mainController = new MainController();
    }

    public function editPage(Request $request)
    {
        $configs = config('config.admin.' . str_replace("/", ".", $request->params));
        $params = $request->route('params');

        if ($request->code) $item = $this->mainController->databaseOperations(['model' => 'App\Models\Main\Product', 'returnvalues' => ['item'], 'where' => ['code' => $request->code], 'create' => false])['item'] ?? null;
        else $item = null;

        $title = $configs['title'];

        if ($item) $files = $this->mainController->databaseOperations(['model' => 'App\Models\Main\Files', 'returnvalues' => ['items'], 'where' => ['type' => 'product', 'type_code' => $request->code], 'create' => false])['items'] ?? null;
        else $files = null;

        $language = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => 'language'], 'create' => false])['items'] ?? [];
        $categories = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => 'categories', 'optional_1' => 'Product'], 'create' => false])['items'] ?? null;
        $cargo_companies = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => 'cargo_companies'], 'create' => false])['items'] ?? null;
        $money_types = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => 'money_type'], 'create' => false])['items'] ?? null;

        return view('admin.data.product.edit', compact('item', 'language', 'title', 'categories', 'cargo_companies', 'money_types', 'params', 'files'));
    }

    public function edit(Request $request)
    {
        //dd($request->toArray());
        $data = $this->mainController->databaseOperations(['model' => 'App\Models\Main\Product', 'returnvalues' => ['item'], 'where' => ['code' => $request->code ?? -1], 'create' => true]);
        $item = Product::where('code', $data['item']->code)->first();
        $isNew = $data['isNew'] ?? false;

        $language = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => 'language'], 'create' => false])['items'] ?? [];

        foreach ($language as $lan) {
            if ($lan->optional_1 == 'tr') continue;
            //dd(!isset($request->language) || !isset($request->language[$lan->optional_1]) || !isset($request->language[$lan->optional_1]['title']) || !isset($request->language[$lan->optional_1]['description']));
            if (!isset($request->language) || !isset($request->language[$lan->optional_1]) || !isset($request->language[$lan->optional_1]['title']) || !isset($request->language[$lan->optional_1]['description'])) continue;

            if ($request->title) {
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

            if ($request->description) {
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

        $item->title = $request->title ?? '';
        $item->short_name = $this->mainController->makeUrl($request->title);
        $item->description = $request->description ?? '';
        $item->category = $request->category ?? '';
        $item->price_without_vat = $request->price_without_vat ?? '';
        $item->priceType_without_vat = $request->priceType ?? '';
        $item->price = $request->price ?? '';
        $item->priceType = $request->priceType ?? '';
        $item->cargo_price = $request->cargo_price ?? '';
        $item->cargo_priceType = $request->priceType ?? '';
        $item->cargo_company = $request->cargo_company ?? '';
        $item->stock = $request->stock ?? '0';
        $item->time = $request->time ?? '0';
        $item->can_be_deleted = 1;
        $item->active = $request->active ? 1 : 0;

        if (!$isNew) $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $main_path = 'files/products/images';
                $path = public_path($main_path);
                $name = $item->code . "_image_" . $index . '.' . $file->getClientOriginalExtension();
                $file->move($path, $name);

                $product_multi = new Files();
                $product_multi->code = $this->mainController->generateUniqueCode('files');
                $product_multi->type = 'product';
                $product_multi->type_code = $item->code;
                $product_multi->file = $main_path . "/" . $name;
                $product_multi->file_type = 'img';
                $product_multi->create_user_code = Auth::guard('admin')->user()->code;
                $product_multi->update_user_code = Auth::guard('admin')->user()->code;
                $product_multi->save();
            }
        }

        return redirect()->route('admin_page', ['params' => $request->post['redirect']['params']])->with('success', $isNew ? 'Created' : 'Updated');
    }

    public function delete(Request $request)
    {
        $item = Product::Where('code', $request->code)->first();
        if (!$item) return redirect()->back()->with('error', 'An error occurred (Product)');

        if ($item->can_be_deleted == 0) return redirect()->back()->with('error', 'This value cannot be deleted');

        $item->delete = 1;
        $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        $configs = config('config.admin.' . str_replace("/", ".", $request->params));

        return redirect()->route('admin_page', ['params' => 'product'])->with('success', 'Deleted');
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

        $result = $this->mainController->databaseOperations(['model' => 'App\Models\Main\Product', 'pagination' => $pagination, 'search' => $search, 'returnvalues' => ['items', 'pageCount'], 'create' => false]);

        return $result;
    }
}
