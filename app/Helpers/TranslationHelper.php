<?php

use App\Models\Translation;
use Illuminate\Support\Facades\Cache;

function lang_db($key, $type = 0, $locale = null)
{
    $locale = $locale ?? getActiveLang();
    $translation = Translation::where('key', $key)->where('language', $locale)->where('type', $type)->first();

    return $translation ? $translation->value : $key;
}

function getActiveLang()
{
    $locale = config('app.locale');

    if (Cache::has('locale'))
        $locale = Cache::get('locale');
    else
        setActiveLang($locale);

    return $locale;
}

function setActiveLang($locale)
{
    if (!$locale) return false;
    Cache::forever('locale', $locale);
    return true;
}
