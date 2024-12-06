<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->join('order_products', 'orders.order_code', '=', 'order_products.order_code')
            ->join('products', 'order_products.product_code', '=', 'products.code')
            ->leftJoin('files', function ($join) {
                $join->on('products.code', '=', 'files.type_code')
                    ->whereRaw('files.id = (SELECT MIN(id) FROM files WHERE files.type_code = products.code)');
            })
            ->leftJoin('user_addresses', function ($join) {
                $join->on('orders.address_code', '=', 'user_addresses.code')
                    ->whereRaw('user_addresses.id = (SELECT MIN(id) FROM user_addresses WHERE user_addresses.code = orders.address_code)');
            })
            ->select(
                'orders.order_code',
                'orders.status as order_status',
                'orders.price as order_price',
                'orders.created_at as order_date',
                'products.code as product_code',
                'products.title as product_title',
                'files.file as first_image',
                'user_addresses.address_name as address_name',
                'user_addresses.address as address',
                'user_addresses.city as city',
                'user_addresses.county as county',
                'user_addresses.post_code as post_code',
                'order_products.product_count as order_product_count',
                'order_products.total_product_price as order_total_product_price',
                'order_products.total_product_price_type as order_total_product_price_type',
            )
            ->orderBy('orders.created_at', 'desc') // Sipariş sıralaması
            ->get()
            ->groupBy('order_code'); // Siparişe göre grupla

        $formattedOrders = $orders->map(function ($group, $orderCode) {
            // Her sipariş için düzenleme
            return [
                'order_code' => $orderCode,
                'order_status' => $group->first()->order_status,
                'order_price' => $group->first()->order_price,
                'address_name' => $group->first()->address_name,
                'address' => $group->first()->address,
                'city' => $group->first()->city,
                'county' => $group->first()->county,
                'post_code' => $group->first()->post_code,
                'order_date' => Carbon::parse($group->first()->order_date)->translatedFormat('d F Y, H:i'), // Tarihi özel formatta döndür
                'products' => $group->map(function ($product) {
                    // Her ürün için düzenleme
                    return [
                        'product_code' => $product->product_code,
                        'product_title' => $product->product_title,
                        'first_image' => $product->first_image ?? null,
                        'order_product_count' => $product->order_product_count,
                        'order_total_product_price' => $product->order_total_product_price,
                        'order_total_product_price_type' => $product->order_total_product_price_type,
                    ];
                })->toArray(),
            ];
        })->values(); // Grupları düz listeye çevir
        $title = 'Orders';
        return view('user.order', compact('title', 'formattedOrders'));
    }
}
