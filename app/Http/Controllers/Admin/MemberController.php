<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
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

        if ($request->code) $item = $this->mainController->databaseOperations(['model' => 'App\Models\User', 'returnvalues' => ['item'], 'where' => ['code' => $request->code], 'create' => false])['item'] ?? null;
        else $item = null;

        $title = $configs['title'];

        return view('admin.user.edit', compact('item', 'title', 'params'));
    }

    public function edit(Request $request)
    {
        $data = $this->mainController->databaseOperations(['model' => 'App\Models\User', 'returnvalues' => ['item'], 'where' => ['code' => $request->code ?? -1], 'create' => true]);
        $item = User::where('code', $data['item']->code)->first();
        $isNew = $data['isNew'] ?? false;

        $item->name = $request->name;
        $item->username = $request->username;
        $item->email = $request->email;
        $item->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = public_path('files/users');
            $name = $item->code . "_" . $this->mainController->generateUniqueCode() . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $item->image = "files/users/" . $name;
        } else $item->image = $item->image ?? '';

        $item->active = $request->active ? 1 : 0;

        if (!$isNew) $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        return redirect()->route('admin_page', ['params' => $request->post['redirect']['params']])->with('success', $isNew ? 'Created' : 'Updated');
    }

    public function delete(Request $request)
    {
        $item = User::Where('code', $request->code)->first();
        if (!$item) return redirect()->back()->with('error', 'An error occurred (Product)');

        if ($item->can_be_deleted == 0) return redirect()->back()->with('error', 'This value cannot be deleted');

        $item->delete = 1;
        $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        $configs = config('config.admin.' . str_replace("/", ".", $request->params));

        return redirect()->route('admin_page', ['params' => 'member'])->with('success', 'Deleted');
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

        $result = $this->mainController->databaseOperations(['model' => 'App\Models\User', 'pagination' => $pagination, 'search' => $search, 'returnvalues' => ['items', 'pageCount'], 'create' => false]);

        return $result;
    }
}
