<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Main\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

        if ($request->code) $item = $this->mainController->databaseOperations(['model' => 'App\Models\Main\AdminUser', 'returnvalues' => ['item'], 'where' => ['code' => $request->code], 'create' => false])['item'] ?? null;
        else $item = null;

        $title = $configs['title'];

        return view('admin.user.edit', compact('item', 'title', 'params'));
    }

    public function edit(Request $request)
    {
        $data = $this->mainController->databaseOperations(['model' => 'App\Models\Main\AdminUser', 'returnvalues' => ['item'], 'where' => ['code' => $request->code ?? -1], 'create' => true]);
        $item = AdminUser::where('code', $data['item']->code)->first();
        $isNew = $data['isNew'] ?? false;

        $item->name = $request->name;
        $item->username = $request->username;
        $item->email = $request->email;
        $item->password = $request->password && $request->password != '' ? Hash::make($request->password) : ($item->password ?? '');

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
        $item = AdminUser::Where('code', $request->code)->first();
        if (!$item) return redirect()->back()->with('error', 'An error occurred (Product)');

        if ($item->can_be_deleted == 0) return redirect()->back()->with('error', 'This value cannot be deleted');

        $item->delete = 1;
        $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        $configs = config('config.admin.' . str_replace("/", ".", $request->params));

        return redirect()->route('admin_page', ['params' => 'user'])->with('success', 'Deleted');
    }

    public function showProfile()
    {
        $title = 'Profile';
        return view('admin.profile', compact('title'));
    }

    public function changeImage(Request $request)
    {
        $user = AdminUser::Where('code', Auth::guard('admin')->user()->code)->first();
        if ($request->hasFile('profileImageInput')) {
            $file = $request->file('profileImageInput');

            $path = public_path('files/users');
            $name = $user->code . "_" . $this->mainController->generateUniqueCode() . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $user->image = "files/users/" . $name;
        }
        $user->save();

        return redirect()->back()->with('success', 'Image changed successfully');
    }

    public function changeProfile(Request $request)
    {
        $user = AdminUser::Where('code', Auth::guard('admin')->user()->code)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        // Validasyon kuralları ve özelleştirilmiş hata mesajları
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);

        if ($request->newPassword != $request->confirmPassword) {
            return redirect()->back()->with('error', 'Password and Repeat Password do not match');
        }

        // Giriş yapan kullanıcı
        $user = AdminUser::Where('code', Auth::guard('admin')->user()->code)->first();

        // Mevcut şifreyi kontrol et
        if (!Hash::check($request->currentPassword, $user->password)) {
            return redirect()->back()->with('error', 'Current Password is Wrong');
        }

        // Şifreyi güncelle
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully');
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

        $result = $this->mainController->databaseOperations(['model' => 'App\Models\Main\AdminUser', 'pagination' => $pagination, 'search' => $search,  'where' => ['type' => ['!=', 0]], 'returnvalues' => ['items', 'pageCount'], 'create' => false]);

        return $result;
    }
}
