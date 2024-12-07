<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Main\KeyValue;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeyValueController extends Controller
{
    protected $mainController;

    public function __construct()
    {
        $this->mainController = new MainController();
    }

    public function editPage(Request $request)
    {
        $configs = config('config.admin.' . str_replace("/", ".", $request->params));
        if (!$configs) abort(404);

        $datas = [];
        foreach ($configs['view']['key'] as $key) {
            $datas[$key] = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => $key], 'create' => false])['items'] ?? '';
        }

        $datas['language'] = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['items'], 'where' => ['key' => 'language'], 'create' => false])['items'] ?? [];

        $datas['title'] = $configs['title'];

        return view($configs['view']['page'], $datas);
    }

    public function edit(Request $request)
    {
        if (!is_array($request->values) || !is_array($request->keys) || count($request->keys) != count($request->values)) return redirect()->back()->with('error', 'An error occurred (Key Value)');

        for ($i = 0; $i < count($request->keys); $i++) {
            $data = $this->mainController->databaseOperations(['model' => 'App\Models\Main\KeyValue', 'returnvalues' => ['item'], 'where' => ['code' => $request->codes[$i] ?? -1, 'key' => $request->keys[$i]], 'create' => true]);
            $item = KeyValue::where('code', $data['item']->code)->first();
            $isNew = $data['isNew'] ?? false;

            if (!$item) return redirect()->back()->with('error', 'An error occurred (Key Value)');
            if (isset($request->optional_5) && isset($request->optional_5[$i]) && $request->hasFile("optional_5.$i")) {
                $file = $request->file("optional_5.$i");
                $main_path = "file/{$item->key}";
                $path = public_path($main_path);
                $name = "{$item->key}_{$item->code}_{$this->mainController->generateUniqueCode(['length' => 5])}.{$file->getClientOriginalExtension()}";
                $file->move($path, $name);
                $item->optional_5 = "{$main_path}/{$name}";
            }

            if ($request->language && is_array($request->language)) {

                foreach ($request->language as $lan_code => $req_lan) {
                    foreach ($req_lan as $lan_type => $language) {
                        $translation = $this->mainController->databaseOperations(['model' => 'App\Models\Translation', 'returnvalues' => ['item'], 'where' => ['key' => $item->value, 'language' => $lan_code], 'create' => false])['item'] ?? null;

                        if ($translation)
                            $translation = Translation::find($translation->id);
                        else
                            $translation = new Translation();

                        if ($lan_type == 'value' && isset($request->values) && isset($request->values[$i])) $lan_key = $request->values[$i];
                        else if ($lan_type == 'optional_1' && isset($request->optional_1) && isset($request->optional_1[$i])) $lan_key = $request->optional_1[$i];
                        else if ($lan_type == 'optional_2' && isset($request->optional_2) && isset($request->optional_2[$i])) $lan_key = $request->optional_2[$i];
                        else if ($lan_type == 'optional_3' && isset($request->optional_3) && isset($request->optional_3[$i])) $lan_key = $request->optional_3[$i];
                        else if ($lan_type == 'optional_4' && isset($request->optional_4) && isset($request->optional_4[$i])) $lan_key = $request->optional_4[$i];
                        else continue;

                        $translation->key = $lan_key;
                        $translation->language = $lan_code;
                        $translation->value = $request->language[$lan_code][$lan_type][$i];
                        $translation->type = -1;
                        $translation->save();
                    }
                }
            }
            $item->value = (isset($request->values) && isset($request->values[$i])) ? $request->values[$i] : "";
            $item->optional_1 = (isset($request->optional_1) && isset($request->optional_1[$i])) ? $request->optional_1[$i] : null;
            $item->optional_2 = (isset($request->optional_2) && isset($request->optional_2[$i])) ? $request->optional_2[$i] : null;
            $item->optional_3 = (isset($request->optional_3) && isset($request->optional_3[$i])) ? $request->optional_3[$i] : null;
            $item->optional_4 = (isset($request->optional_4) && isset($request->optional_4[$i])) ? $request->optional_4[$i] : null;

            if (!$isNew) $item->update_user_code = Auth::guard('admin')->user()->code;

            $item->save();
        }

        return redirect()->route('admin_page', ['params' => $request->post['redirect']['params']])->with('success', 'Updated');
    }

    public function editShow(Request $request)
    {
        $show_about = KeyValue::Where('key', 'show_about')->first();
        if (!$show_about) {
            $show_about = new KeyValue();
            $show_about->key = 'show_about';
            $show_about->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
        }
        $show_about->value = $request->show_about ? '1' : '0';
        $show_about->save();

        $show_page = KeyValue::Where('key', 'show_page')->first();
        if (!$show_page) {
            $show_page = new KeyValue();
            $show_page->key = 'show_page';
            $show_page->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
        }
        $show_page->value = $request->show_page ? '1' : '0';
        $show_page->save();

        $show_process = KeyValue::Where('key', 'show_process')->first();
        if (!$show_process) {
            $show_process = new KeyValue();
            $show_process->key = 'show_process';
            $show_process->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
        }
        $show_process->value = $request->show_process ? '1' : '0';
        $show_process->save();

        $show_services = KeyValue::Where('key', 'show_services')->first();
        if (!$show_services) {
            $show_services = new KeyValue();
            $show_services->key = 'show_services';
            $show_services->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
        }
        $show_services->value = $request->show_services ? '1' : '0';
        $show_services->save();

        $show_suppliers = KeyValue::Where('key', 'show_suppliers')->first();
        if (!$show_suppliers) {
            $show_suppliers = new KeyValue();
            $show_suppliers->key = 'show_suppliers';
            $show_suppliers->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
        }
        $show_suppliers->value = $request->show_suppliers ? '1' : '0';
        $show_suppliers->save();

        $show_contact = KeyValue::Where('key', 'show_contact')->first();
        if (!$show_contact) {
            $show_contact = new KeyValue();
            $show_contact->key = 'show_contact';
            $show_contact->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
        }
        $show_contact->value = $request->show_contact ? '1' : '0';
        $show_contact->save();

        $show_whatsapp = KeyValue::Where('key', 'show_whatsapp')->first();
        if (!$show_whatsapp) {
            $show_whatsapp = new KeyValue();
            $show_whatsapp->key = 'show_whatsapp';
            $show_whatsapp->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
        }
        $show_whatsapp->value = $request->show_whatsapp ? '1' : '0';
        $show_whatsapp->save();

        $show_user_login = KeyValue::Where('key', 'show_user_login')->first();
        if (!$show_user_login) {
            $show_user_login = new KeyValue();
            $show_user_login->key = 'show_user_login';
            $show_user_login->code = $this->mainController->generateUniqueCode(['table' => 'key_values']);
        }
        $show_user_login->value = $request->show_user_login ? '1' : '0';
        $show_user_login->save();


        return redirect()->route('admin_page', ['params' => $request->post['redirect']['params']])->with('success', 'Updated');
    }

    public function delete(Request $request)
    {
        $item = KeyValue::Where('code', $request->code)->first();
        if (!$item) return redirect()->back()->with('error', 'An error occurred (Key Value)');

        if ($item->can_be_deleted == 0) return redirect()->back()->with('error', 'This value cannot be deleted');

        $item->delete = 1;
        $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        $configs = config('config.admin.' . str_replace("/", ".", $request->params));

        return redirect()->route('admin_page', ['params' => $configs['view']['redirect']['params']])->with('success', 'Deleted');
    }

    public function getData() {}
}
