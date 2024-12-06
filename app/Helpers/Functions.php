<?php

use App\Models\Main\KeyValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

function checkAuth($data = [])
{

    if (isset($data) && !is_array($data)) return ['status' => false, 'redirect' => null];

    if (!isset($data['params'])) $data['params'] = 'admin/';

    $params = str_replace('admin.', '', str_replace("/", '.', $data['params']));

    $auth = -999;
    $authorization = -999;
    $param_control = $params != "" ? explode(".", $params) : [];
    $not_found = false;

    // config yetkilendirme ve erişim durumu kontrolleri
    for ($i = count($param_control); $i > 0; $i--) {
        $config_auth = config('config.admin.' . implode('.', array_slice($param_control, 0, $i)));

        if (!isset($config_auth)) {
            $not_found = true;
            break;
        }

        if (isset($config_auth['auth']) && $auth == -999) {
            $auth = $config_auth['auth'];
        }

        if (isset($config_auth['authorization']) && $authorization == -999) {
            $authorization = $config_auth['authorization'];
        }

        if ($auth != -999 && $authorization != -999) break;
    }

    if ($auth == -999) $auth = 1;
    if ($authorization == -999) $authorization = 0;
    if ($not_found || !in_array($auth, [1, -1, 0])) return ['status' => false, 'redirect' => '404'];

    $isAuthenticated = Auth::guard('admin')->check();

    // Erişim durumlarına göre yönlendirme veya yetkilendirme durumu belirleme
    if ($auth == 1) {
        if (!$isAuthenticated) return ['status' => false, 'redirect' => 'login'];
        if ($authorization == 1 && Auth::guard('admin')->user()->type != 0) return ['status' => false, 'redirect' => ' no_access_authorization'];
        if ($authorization == 2 && (Auth::guard('admin')->user()->type != 0 || Auth::guard('admin')->user()->type != 1)) {
            //TODO: Yetkilendirme eklendiğinde buraya eklenecek. $authorization == 2 yetkilendirme için kullanılacak. Tabii kullancıı türü 0 ve 1 ise her zaman true olması gerekmeketidR bu durumda bu if'e hiçbir zaman girmemeli.
        }
    }

    if ($auth == -1 && $isAuthenticated) {
        return ['status' => false, 'redirect' => 'already_logged_in'];
    }

    return ['status' => true, 'redirect' => null];
}

function getCachedKeyValue($data = [])
{
    $key = $data['key'] ?? null; //istenilen key değeri
    $refreshCache = $data['refreshCache'] ?? false; //cache yenilenecek mi?
    $delete = $data['delete'] ?? false; // delete değeri sorgulanacak mı ?
    $first = $data['first'] ?? false; // first mi get mi?
    $value = $data['value'] ?? null; // value değeri sorgulanacak mı?
    $optional_2 = $data['optional_2'] ?? null; // optional_2 değeri sorgulanacak mı?
    $orderBy = $data['orderBy'] ?? null; // orderBy olacak mı?
    $orderByType = $data['orderByType'] ?? "ASC"; // orderBy olacak mı?

    // sorgulanacak cache değeri
    $cacheKey = "key_value_data_{$key}_" . ($first ? 'first' : 'get') . "_" . ($value ?? 'not_exist');
    // Eğer cache varsa ve cache yenilenmeyecekse direk cache deki değeri yolla
    if (!$refreshCache && Cache::has($cacheKey)) {
        return Cache::get($cacheKey);
    }

    // İstenilen değeri db den çek
    $query = KeyValue::where('key', $key);

    //Value kontrol edilecekse sorguya ekle
    if (!is_null($value))
        $query->where('value', $value);

    if (!is_null($optional_2)) {
        $query->where('optional_2', $optional_2);
    }

    //delete kontrol edilecekse sorguya ekle
    if ($delete)
        $query->where('delete', 0);

    //sıralama var mı?
    if ($orderBy)
        $query->orderBy($orderBy, $orderByType);

    //first ya da get durumuna göre sorguyu çek.
    $query = $first ? $query->first() : $query->get();

    // Cache'ye kaydet ve return yap.
    if ($query) {
        Cache::put($cacheKey, $query, now()->addMinutes(60)); // 60 dakikalığına cache'ye kaydet
        return $query;
    }

    return null; // sorgu da hata verirse null dön.
}

function getPriceAllTypes()
{
    $price_types = getCachedKeyValue(['key' => 'money_type', 'refreshCache' => true]);

    return $price_types;
}

function getPriceType($price_type)
{
    $price_type = getCachedKeyValue(['key' => 'money_type', 'value' => $price_type, 'refreshCache' => true, 'first' => true]);

    return $price_type;
}

function getPriceTypeSymbol($price_type)
{
    return getPriceType($price_type)->optional_1;
}
