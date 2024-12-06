<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Main\UserAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $mainController;

    public function __construct()
    {
        $this->mainController = new MainController();
    }

    public function index()
    {
        $title = 'Dashboard';
        return view('user.index', compact('title'));
    }
    public function loginScreen()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password]) || Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::user()->delete == 0 && Auth::user()->active == 1)
                return redirect()->route('user.user')->with('success', 'Welcome!');
            else Auth::logout();
        }
        return redirect()->back()->with('error', 'Username or password is incorrect');
    }

    public function registerScreen()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        if ($request->password != $request->repeat_password) {
            return redirect()->back()->with('error', 'Password and Repeat Password do not match');
        }
        $user = new User();
        $user->code = $this->mainController->generateUniqueCode(['table' => 'users']);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);

        return redirect()->route('user.user')->with('success', 'Welcome!');
    }

    public function profileScreen()
    {
        $title = 'Profile';
        $addresses = UserAddress::Where('user_code', Auth::user()->code)->where('delete', 0)->get();
        return view('user.profile', compact('title', 'addresses'));
    }

    public function changeImage(Request $request)
    {
        $user = User::Where('code', Auth::user()->code)->first();
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
        $user = User::Where('code', Auth::user()->code)->first();
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
        $user = User::Where('code', Auth::user()->code)->first();

        // Mevcut şifreyi kontrol et
        if (!Hash::check($request->currentPassword, $user->password)) {
            return redirect()->back()->with('error', 'Current Password is Wrong');
        }

        // Şifreyi güncelle
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function editAddress(Request $request)
    {
        $address = UserAddress::Where('code', $request->code)->first();

        // Eğer adres yoksa yeni bir adres eklemek için bir yeni nesne oluştur
        if (!$address) {
            $address = new UserAddress();
            $address->code = $this->mainController->generateUniqueCode(['table' => 'user_addresses']);
        }

        $address->user_code = Auth::user()->code;
        $address->address_name = $request->address_name;
        $address->address = $request->address;
        $address->city = $request->city;
        $address->county = $request->county;
        $address->post_code = $request->post_code;
        $address->save();

        return redirect()->back()->with('success', 'Addresses updated successfully');
    }

    public function deleteAddress(Request $request)
    {
        $address = UserAddress::Where('code', $request->code)->Where('user_code', Auth::user()->code)->first();
        if ($address) {
            $address->delete = 1;
            $address->save();
        }
        return redirect()->back()->with('success', 'Address deleted successfully');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login')->with("success", lang_db('Logout Successfully', 2));
    }
}
