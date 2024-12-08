<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Main\Contact;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $mainController;

    public function __construct()
    {
        $this->mainController = new MainController();
    }

    public function index()
    {
        return $this->getThemeFunction(__FUNCTION__, null); // şuanki fonksiyon adını ve pageCode'u yollar. pageCode null olunca tema metoduna yollanmaz
    }

    public function blogs()
    {
        return $this->getThemeFunction(__FUNCTION__, null);
    }

    public function blog_detail($pageCode)
    {
        return $this->getThemeFunction(__FUNCTION__, $pageCode);
    }

    public function products()
    {
        return $this->getThemeFunction(__FUNCTION__, null);
    }

    public function galleries()
    {
        return $this->getThemeFunction(__FUNCTION__, null);
    }


    public function product_detail($pageCode)
    {
        return $this->getThemeFunction(__FUNCTION__, $pageCode);
    }

    public function contact()
    {
        return $this->getThemeFunction(__FUNCTION__, null);
    }

    public function sendMessage(Request $request)
    {
        $contact = new Contact();

        $contact->code = $this->mainController->generateUniqueCode(['table' => 'contacts']);
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->text = $request->message;
        $contact->save();

        return response()->json([
            'class' => 'alert alert-success',
            'message' => lang_db('Your message has been sent', 1),
        ]);
    }

    function getThemeFunction($method, $pageCode = null)
    {
        $active_theme = ucfirst(getActiveTheme()); // "becki" => "Becki"
        $controller_class = "App\\Http\\Controllers\\Index\\Themes\\{$active_theme}Controller";

        // Sınıf ve method mevcut mu kontrol et
        if (class_exists($controller_class) && method_exists($controller_class, $method)) {
            if (is_null($pageCode))
                return app($controller_class)->$method();
            else
                return app($controller_class)->$method($pageCode);
        }
        dd($active_theme);
        // Sınıf ya da method yoksa hata döndür
        abort(404);
    }
}
