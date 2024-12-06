<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    protected $mainController;

    public function __construct()
    {
        $this->mainController = new MainController();
    }

    public function admin(Request $request)
    {
        try {
            //Post/Get kontrolu. İkisi de değilse 404'e düşer.
            if ($request->isMethod('post')) $methot = 'post';
            else if ($request->isMethod('get')) $methot = 'get';
            else abort(404);

            //Url kontrolü. params da herhangi bir değer yoksa varsayılan admin sayfası kaile alınır.
            $params = $request->route('params');
            if ($params) $configs = config('config.admin.' . str_replace("/", ".", $params));
            else $configs = config('config.admin');
            $request->merge(['params' => $params]);

            //Params varsa ve configs yoksa bir sayfaya gidilmek isteniyordur ama o sayfa tanımlanmamıştır. Bu sebeple 404 sayfasına yolluyoruz.
            if ($params && !$configs) abort(404);

            //Gelen işlem get veya post ise farklı şekilde işlem uygulayacağız.
            if ($methot == 'get') {

                //gelen işlem get ise ve config içeriisnde view, view->page ve view->type değişkenleri mevcut değilse bu url'de get metodu kabul edilmiyordur. Bu sebeple hata verirse Sayfa bulunamadı deyip admin sayfasına yönlendiriyoruz.
                if (isset($configs['view']) && isset($configs['view']['page']) && isset($configs['view']['type'])) {
                    if ($params == '' || $params == null) $title = config('config.admin.title') ? lang_db(config('config.admin.title')) : '';
                    else $title = config('config.admin.' . str_replace("/", ".", $params) . '.title') ? lang_db(config('config.admin.' . str_replace("/", ".", $params) . '.title')) : '';

                    $request->merge(['title' => $title]);
                    $request->merge(['page' => $configs['view']['page']]); //Hangi sayfaya gideceğini $request'e ekliyoruz.
                    if (isset($configs['view']['datas'])) $request->merge(['datas' => $configs['view']['datas']]); //sayfaya giderken bir değişken çekmesi gerekiyorsa bunu config de belirtiyoruz. Ve burada çekmesi gereken değişkenleri $request'e ekliyoruz.

                    //En son gelen değerlere göre istenilen fonksiyona request ile birlikte yolluyoruz.
                    return app()->call("App\Http\Controllers{$configs['view']['type']}", ['request' => $request]);
                } else return redirect()->route('admin_page')->with('error', 'Page Not Found'); //Eğer view yada içeriği yoksa sayfa bulunamadı hatası dönüyorruz
            } else if ($methot == 'post') {

                //post işlmei geldiyse ve url de post yoksa post desteklenmemektedir. Bunu belirtemk için if-else fonksiyonumuz mevcuttur.
                if (isset($configs['post'])) {
                    //Post işlemleri le ilgili bütün değerleri $request'e ekliyoruz.
                    $request->merge(['post' => $configs['post']]);

                    //Eğer post işlemi yaparken bir veri çekilmesi gerekiyorsa bu veri ile ilgili bütün değerleri $request'e ekliyoruz
                    if (isset($configs['post']['datas'])) $request->merge(['datas' => $configs['post']['datas']]);

                    //En sonda istenilen fonksiyona $request ile birlikte yolluyoruz.
                    return app()->call("App\Http\Controllers{$configs['post']['type']}", ['request' => $request]);
                } else return redirect()->route('admin_page')->with('error', 'Post is not supported'); //Eğğer post desteklenmiyorsa hata mesajı dönüyoruz.
            } else abort(404); //Yukarıda kontrol ediyoruz ama burada da önlem amaçlı kontrol ediyoruz. Post ya da get gelmez ise 404'e dönüyoruz.

        } catch (\Throwable $th) {
            abort(404); //Eğer yukarıdaki işlemlerden herhangi bir tanesinde hata verirse hata ekranı yerine 404 ekranına yönlendiriyoruz.
        }

        return;
    }

    public function showPage(Request $request)
    {
        if (!isset($request->page)) abort(404);
        $datas = [];
        $with_type = '';
        $with_message = '';
        $with_route = null;
        $datas['params'] = $request->route('params');
        if ($request->datas) {
            foreach ($request->datas as $key => $value) {
                $datas[$key] = $this->mainController->databaseOperations($value['data']);
                if (!$value['required']) $value['required'] = false;
                if ($value['required'] && !$datas[$key]) {
                    $with_route = $value['error']['route'] ?? $request->page;
                    $with_type = $value['error']['with']['type'] ?? '';
                    $with_message = $value['error']['with']['message'] ?? '';
                }
            }
        }
        $datas['title'] = $request->title;

        return view($with_route ?? $request->page, $datas)->with($with_type, $with_message);
    }

    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->username, 'password' => $request->password]) || Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::guard('admin')->user()->delete == 0 && Auth::guard('admin')->user()->active == 1)
                return redirect()->route($request->post['redirect']['success']['route'], $request->post['redirect']['success']['values'])->with($request->post['redirect']['success']['with']['type'], $request->post['redirect']['success']['with']['message']);
            else Auth::guard('admin')->logout();
        }

        return redirect()->route($request->post['redirect']['error']['route'], $request->post['redirect']['error']['values'])->with($request->post['redirect']['error']['with']['type'], $request->post['redirect']['error']['with']['message']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_page', ['params' => 'login'])->with("success", lang_db('Logout Successfully'));
    }

    public function getData(Request $request) {}
}
