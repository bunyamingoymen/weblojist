<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function assetFile($folder, $filename)
    {
        // Referer kontrolü: Yalnızca Laravel sayfalarından gelen istekler kabul edilir
        $referer = request()->headers->get('referer');
        $host = request()->getHost();

        // Eğer referer başlığı yoksa veya farklı bir yerden geliyorsa 403 döndür
        if (!$referer || !str_contains($referer, $host)); //return abort(403, 'Unauthorized access');


        $filePath = 'app/private/assets/' . $folder . '/' . $filename;

        if (file_exists(storage_path($filePath))) {

            if (str_ends_with($filename, '.css')) $mimeType = 'text/css';
            elseif (str_ends_with($filename, '.js')) $mimeType = 'application/javascript';
            elseif (str_ends_with($filename, '.jpg') || str_ends_with($filename, '.jpeg')) $mimeType = 'image/jpeg';
            elseif (str_ends_with($filename, '.png')) $mimeType = 'image/png';
            elseif (str_ends_with($filename, '.gif')) $mimeType = 'image/gif';
            elseif (str_ends_with($filename, '.svg')) $mimeType = 'image/svg+xml';
            elseif (str_ends_with($filename, '.webp')) $mimeType = 'image/webp';
            elseif (str_ends_with($filename, '.ico')) $mimeType = 'image/x-icon';
            else $mimeType = mime_content_type(storage_path($filePath));

            return response()->file(storage_path($filePath), ['Content-Type' => $mimeType]);
        }

        return abort(404);
    }

    public function generateUniqueCode($data = [])
    {

        $database = $data['database'] ?? config('database.default');; // hangi sql bağlantısı. Varsayılan olarak uygulamadan çekilir
        $table = $data['table'] ?? null; // Hangi tablo. Null olursa sadece 1 tane uniq kod oluşturup yollar.
        $column = $data['column'] ?? 'code'; //Unique kod oluşturulurken hangi kolon kontrol edilecek.
        $length = $data['length'] ?? 10; //unique kod kontrolu

        // Belirli bir veritabanı bağlantısını kullanarak kontrol et
        $connection = DB::connection($database);

        do {
            // Rastgele bir kod oluştur
            $code = Str::lower(Str::random($length));

            // Oluşturulan kodun mevcut tabloda olup olmadığını kontrol et
            if (is_null($table)) break;
            $exists = $connection->table($table)->where($column, $code)->exists();
        } while ($exists);

        return $code;
    }

    public function makeUrl($name)
    {
        $acceptable = array_merge(range('a', 'z'), range('0', '9')); // Tüm harfler ve sayıları birleştirip bir dizi oluşturulur
        $change = ['ç' => 'c', 'ö' => 'o', 'ı' => 'i', 'ş' => 's', 'ğ' => 'g', 'ü' => 'u'];

        // Türkçe karakter dönüşümleri
        $name = strtr(mb_strtolower($name), $change); //strtr stringteki istenilen değerleri otomatik olarak dönüştürür.

        $url = '';

        // Gelen ismi karakter karakter parçalayarak kontrol ediyoruz
        for ($i = 0; $i < mb_strlen($name); $i++) {
            $character = mb_substr($name, $i, 1);
            if (in_array($character, $acceptable)) {
                $url .= $character;
            } else {
                $url .= "-"; // Kabul edilmeyen karakter yerine "-" koyuluyor.
            }
        }

        return $url; // oluşturulan url dönülüyor.
    }

    public function databaseOperations($data = [])
    {
        /*
            Açıklamalar ve örnek kodlar:

            Örnek joins: $joins = [ ['table' => 'categories', 'first' => 'category_id', 'operator' => '=', 'second' => 'categories.id', 'columns'=>['name'=>'category_name', 'code'=>'category_code']] ];

            Örnek leftjoin:
            $leftJoins = [
                ['table' => 'shop_files', 'first' => 'code', 'operator' => '=', 'second' => 'shop_files.parent_code', 'columns' => ['path' => 'image_path', 'parent_code' => 'parent_code']],
                ['table' => 'shop_whishlists', 'first' => 'code', 'operator' => '=', 'second' => 'shop_whishlists.product_code', 'columns' => ['product_code' => 'whislist_product_code', 'deleted' => 'whislist_deleted', 'user_code' => 'whislist_user_code'], 'where' => ['deleted' => ['can_be_null' => false, 'value' => 0], 'user_code' => Auth::guard('shop_users')->user()->code,]],
                ['table' => 'shop_carts', 'first' => 'code', 'operator' => '=', 'second' => 'shop_carts.product_code', 'columns' => ['product_code' => 'cart_product_code', 'user_code' => 'whislist_user_code'], 'where' => ['user_code' => Auth::guard('shop_users')->user()->code]]
            ];
        */
        // Anahtarları küçük harfe çevir. Kontrolden önce bütün anahtarlar küçük harfe dönüştürülür. Büyük harfler kabul edilmez.
        $data = array_change_key_case($data, CASE_LOWER);

        if (!isset($data['model']) || !isset($data['returnvalues'])) return null; //Model ve gönderilecek değerler olmak zorundadır. Yoksa null döner.

        /*
        returnvalues values de şu şartlar sağlanamaz:
            -   item tek değer almak içindir. items ise get yani çoklu değer almak içindir. Bu sebeple ikisi de aynı anda bulunamaz.
            -   item tekli olduğu için pagination da olamaz. ikisi de aynı anda bulunamaz
            -   item tekli değer olduğu için sayfa sayısı da istenemez. Sonuçta bir değer dönecek.
        Bu 3 şarttan bir tanesine uymazsa null olarak dönülmektedir.

        */

        if ((in_array('item', $data['returnvalues']) && in_array('items', $data['returnvalues'])) || (in_array('item', $data['returnvalues']) && isset($data['pagination'])) || (in_array('item', $data['returnvalues']) && in_array('pageCount', $data['returnvalues']))) return null;

        //item yada itemsdan en az bir tanesi olmak zorunda. Sonuçta ya get yapılmalı ya da post
        if (!in_array('item', $data['returnvalues']) && !in_array('items', $data['returnvalues'])) return null;

        $database = $data['database'] ?? config('database.default');  // hangi sql bağlantısı. Varsayılan olarak configden alınır.

        $model = $data['model'];

        $returnvalues = $data['returnvalues']; //Gönderilecek değerler. totalCount(Toplam veri), pageCount(sayfa sayısı), items(veriler), item(veri), query(oluşturulan sql sorgusu). item ile items aynı anda istenemez. İstenirse hata verir.

        //db de where işlemi yapabilmek için
        $where = $data['where'] ?? [];

        //Silinmişler getirilicek mi diye kontrol eidliyor. Varsayılan olarak silinmemişler getirilir.
        $delete = $data['delete'] ?? 0;

        // Arama ayarları (Varsayılan boş dizi)
        $search = $data['search'] ?? [];

        // WhereIn koşulları (Varsayılan boş dizi)
        $whereIn = $data['wherein'] ?? [];

        // Sayfalama ayarları (Varsayılan olarak 1 kayıt alır. Eğer sayfalama yapılmak isteniyorsa bu çağrılır. İstenmiyorsa çağrılmaz.) ['take' => 15, 'page' => 1]
        $pagination = $data['pagination'] ?? null;

        //Eğer pagination null ise tek bir değer dönecek demektir. Eğer o değer null ise kullanıcı yeni bir değer oluşturulup dönmesini isteyebilir. bu durumda $create değeri kontrol edilir. $create true ise yeni değer oluşturulup o döndürülür. Varsayılan değer false dur.
        if (!isset($pagination)) $create = $data['create'] ?? false;
        else $create = false;

        // Join ve left join ayarları (Varsayılan boş dizi)
        $joins = $data['joins'] ?? [];
        $leftJoins = $data['leftjoins'] ?? [];

        //groupBy isteniyorsa true döner, varsayılan false'dur.
        $groupBy = $data['groupby'] ?? false;

        //Belli bir sıra isteniyorsa. Varsayılan olarak dbdeğerleri nasıl dönerse o kabul edilir.
        $orderBy = $data['orderby'] ?? null;

        //Zorunlu mu? Null gelirse null döner ve hata verir.
        $required = $data['required'] ?? false;



        //------Yukarısı değişken tanımlama işlemleriydi. Artık sql sorgusu başlatıyoruz.

        $mainTableAlias = $data['maintablealias'] ?? 'main'; //sql sorgusu kullanırken karışmaması için orijinal tabloya isim veriyoruz.

        $result = []; //sonuç kümesi

        // Veritabanı ile bağlantı kur.
        $connection = DB::connection($database);

        // Modelin tablo adını al
        $table = (new $model)->getTable() . ' as ' . $mainTableAlias;

        // Başlangıç query
        $query = $connection->table($table);

        // Seçilecek sütunları ekle
        $mainTableColumns = $connection->getSchemaBuilder()->getColumnListing((new $model)->getTable());
        $selectColumns = [];
        if ($groupBy) $groupByColumns = []; //groupBy varsa groupBy için ana tablonun tüm sütunlarını ekle

        //Ana tablonun bütün sütunlarını ekliyoruz.
        foreach ($mainTableColumns as $column) {
            $selectColumns[] = $mainTableAlias . '.' . $column; // Ana tablodaki tüm sütunlar
            if ($groupBy) $groupByColumns[] = $mainTableAlias . '.' . $column;
        }

        // Join işlemi
        if (!empty($joins)) {
            foreach ($joins as $index => $join) {
                if (isset($join['table'], $join['first'], $join['operator'], $join['second'], $join['columns'])) {
                    // Join işlemi
                    $first = strpos($join['first'], '.') ? $join['first'] : $mainTableAlias . '.' . $join['first'];
                    $second = strpos($join['second'], '.') ? $join['second'] : $mainTableAlias . '.' . $join['second'];

                    $query->join($join['table'], $first, $join['operator'], $second);

                    // Join edilen tablonun belirli sütunlarını alias ile ekle
                    foreach ($join['columns'] as $column => $alias) {
                        if (strpos($column, '.'))  $selectColumns[] = $column . ' as ' . $alias;
                        else $selectColumns[] = $join['table'] . '.' . $column . ' as ' . $alias;

                        if ($groupBy) {
                            if (strpos($column, '.'))  $groupByColumns[] = $column;
                            else  $groupByColumns[] = $join['table'] . '.' . $column;
                        }
                    }
                }
            }
        }

        //left join işlemleri
        if (!empty($leftJoins)) {
            foreach ($leftJoins as $index => $left) {
                if (isset($left['table'], $left['first'], $left['operator'], $left['second'], $left['columns'])) {
                    $first = strpos($left['first'], '.') ? $left['first'] : $mainTableAlias . '.' . $left['first'];
                    $second = strpos($left['second'], '.') ? $left['second'] : $mainTableAlias . '.' . $left['second'];
                    // Alt sorgu ile LIMIT 1 eklenmiş join
                    $subQuery = $connection->table($left['table']);
                    $subQuerySelect = [];
                    foreach ($left['columns'] as $column => $alias) {
                        $col = (strpos($column, '.')) ? $column : $left['table'] . '.' . $column;
                        $subQuerySelect[] = $col;
                        $selectColumns[] = $col . ' as ' . $alias;

                        if ($groupBy) {
                            $groupByColumns[] = $col;
                        }
                    }


                    if (isset($left['where'])) {
                        foreach ($left['where'] as $left_where_index => $left_where) {
                            $left_column = (strpos($left_where_index, '.')) ? $left_where_index : $left['table'] . '.' . $left_where_index;
                            if (isset($left_where['can_be_null'])) {
                                if ($left_where['can_be_null']) $subQuery->where($left_column, $left_where['value'])->orWhere($left_column, null);
                                else $subQuery->where($left_column, $left_where['value']);
                            } else {
                                $subQuery->where($left_column, $left_where)->orWhere($left_column, null);
                            }
                        }
                    }

                    $subQuery->select($subQuerySelect)->orderBy('created_at', 'desc')->limit(1);
                    $query->leftJoinSub($subQuery, $left['table'], $first, $left['operator'], $second);

                    // Select edilen sütunlar

                }
            }
        }

        //where işlemleri:

        //Eğer ana tabloda delete sütunu varsa ve bizden belirli bir delete değeri istenmişse o değer getirilir. Eğer bizden belirli bir delete değeri istenmemişse $delete değişkeni -1 olur ve bu durumda delete kontrol edilmez. Hepsi getirilir.
        if (in_array($mainTableAlias . '.delete', $selectColumns) && $delete != -1) $where['delete'] = $delete;

        // Filtreleri uygula
        foreach ($where as $column => $value) {
            $col = strpos($column, '.') ? $column : $mainTableAlias . '.' . $column;
            $type = is_array($value) ? $value[0] : '=';
            $val = is_array($value) ? $value[1] : $value;

            $query->where($col, $type, $val);  // bütün where'ler ana sorguya uygulanır.

        }

        // Arama işlemi
        if (isset($search['search']) && is_string($search['search']) && isset($search['dbSearch']) && is_array($search['dbSearch'])) {
            $query->where(function ($q) use ($search, $mainTableAlias) {
                // İlk kolon için where kullanıyoruz
                $firstColumn = true;
                foreach ($search['dbSearch'] as $column) {
                    if ($firstColumn) {
                        if (strpos($column, '.')) $q->where($column, 'LIKE', '%' . $search['search'] . '%');
                        else $q->where($mainTableAlias . '.' . $column, 'LIKE', '%' . $search['search'] . '%');
                        $firstColumn = false;
                    } else {
                        if (strpos($column, '.'))  $q->orWhere($column, 'LIKE', '%' . $search['search'] . '%');
                        else $q->orWhere($mainTableAlias . '.' . $column, 'LIKE', '%' . $search['search'] . '%');
                    }
                }

                // Eğer kısa isim ya da URL de aranmak istenirse
                if (isset($search['short_name']) && isset($search['short_name_db']) && $search['short_name']) {
                    $shortName = $this->makeUrl($search['search']);
                    if (strpos($column, '.'))  $q->orWhere($search['short_name_db'], 'LIKE', '%' . $shortName  . '%');
                    else $q->orWhere($mainTableAlias . '.' . $search['short_name_db'], 'LIKE', '%' . $shortName  . '%');
                }
            });
        }

        // WhereIn işlemi
        if (!empty($whereIn) && count($whereIn) > 0) {
            foreach ($whereIn as $column => $values) {
                if (is_array($values) && count($values) > 0) {
                    if (strpos($column, '.')) $query->whereIn($column, $values);
                    else $query->whereIn($mainTableAlias . '.' . $column, $values);
                }
            }
        }

        //Seçilen kolonları ana sorguya ekle
        $query->select($selectColumns);

        //groupBy varsa uygula
        if ($groupBy) $query->groupBy($groupByColumns);

        //orderBy varsa uygula
        if ($orderBy) {
            if (strpos($orderBy['column'], '.'))  $orderByColumn = $orderBy['column'];
            else {
                //put_table: başına tablo adı eklensin mi adında bir bool değerdir. Bu değer yoksa varsayılan olarak eklenir. Bu değer varsa ve true ise de eklenir.
                if (!isset($orderBy['put_table']) || (isset($orderBy['put_table']) && $orderBy['put_table']))
                    $orderByColumn = $mainTableAlias . '.' . $orderBy['column'];
                else $orderByColumn = $orderBy['column'];
            }
            $query->orderBy($orderByColumn, $orderBy['type']);
        }

        if (in_array('query', $returnvalues)) {
            $result['query'] = $query;
        }

        if (in_array('totalCount', $returnvalues)) {
            $result['totalCount'] = $query->count();
        }

        if (in_array('item', $returnvalues)) {
            $result['item'] = $query->first();

            //First yapıldığında değer gelmemişse ve değer gelemdiğinde create yap true ise yeni değer oluşturup o değeri atıyoruz.
            if (!$result['item'] && $create) {
                $result['item'] = new $model;
                //Eğer tablomuzda unique code değeri varsa code değeri atıyoruz.
                if (in_array($mainTableAlias . '.code', $selectColumns)) $result['item']->code = $this->generateUniqueCode(['database' => $database, 'table' => $result['item']->getTable()]);

                //Tabloda create_user_code değeri varsa onu alıyoruz.
                if (in_array($mainTableAlias . '.create_user_code', $selectColumns)) $result['item']->create_user_code =  Auth::guard('admin')->user()->code;
                $result['isNew'] = true;
                foreach ($where as $key => $value) {
                    if ($key == 'delete' || $key == 'code') continue;
                    $result['item']->$key = $value;
                }
                $result['item']->save();
            }


            if (!$result['item'] && $required) return null;
        } else if (in_array('items', $returnvalues)) {
            $pagination['take'] =  $pagination['take'] ?? 15;
            $pagination['page'] = $pagination['page'] ?? 1;

            $take = $pagination['take'];
            $skip = (($pagination['page'] - 1) * $take);

            $result['items'] = $query->skip($skip)->take($take)->get();
            if (in_array('pageCount', $returnvalues))
                $result['pageCount'] = ceil($query->count() / $take);

            if (!$result['items'] && $required) return null;
        } else return null;



        return $result;
    }
}
