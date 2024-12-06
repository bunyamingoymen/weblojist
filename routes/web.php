<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Index\IndexController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\UserController as UserUserController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Middleware\RedirectMiddleware;
use App\Http\Middleware\UserLoginMiddeware;
use App\Http\Middleware\UserRedirectMiddeware;
use App\Models\Main\KeyValue;
use Illuminate\Support\Facades\Route;

//Index:
Route::get('/', [IndexController::class, "index"])->name('index.index');

Route::post('/sendMessage', [IndexController::class, "sendMessage"])->name('index.sendMessage');

Route::get('/blogs', [IndexController::class, "blogs"])->name('index.blogs');

Route::get('/p/{pageCode}', [IndexController::class, "blog_detail"])->name('index.blog.detail');

Route::get('/products', [IndexController::class, "products"])->name('index.products');

Route::get('/product/{pageCode}', [IndexController::class, "product_detail"])->name('index.product.detail');

Route::get('/gallery', [IndexController::class, "galleries"])->name('index.galleries');

Route::get('/contact', [IndexController::class, "contact"])->name('index.contact');



//User:
Route::middleware([UserRedirectMiddeware::class])->group(function () {
    Route::get('/login', [UserUserController::class, "loginScreen"])->name('user.login');
    Route::post('/login', [UserUserController::class, "login"])->name('user.login.post');

    Route::get('/register', [UserUserController::class, "registerScreen"])->name('user.register');
    Route::post('/register', [UserUserController::class, "register"])->name('user.register.post');
});


Route::middleware([UserLoginMiddeware::class])->group(function () {
    Route::get('/user', [UserUserController::class, "index"])->name('user.user');
    Route::get('/user/profile', [UserUserController::class, "profileScreen"])->name('user.profile');
    Route::get('/user/logout', [UserUserController::class, "logout"])->name('user.logout');

    Route::post('/user/changeImage', [UserUserController::class, "changeImage"])->name('user.change.image');
    Route::post('/user/changeProfile', [UserUserController::class, "changeProfile"])->name('user.change.profile');
    Route::post('/user/changePassword', [UserUserController::class, "changePassword"])->name('user.change.password');
    Route::post('/user/editAddress', [UserUserController::class, "editAddress"])->name('user.edit.address');
    Route::get('/user/deleteAddress', [UserUserController::class, "deleteAddress"])->name('user.delete.address');

    Route::get('/user/cart', [CartController::class, "index"])->name('user.cart');
    Route::get('/user/order', [OrderController::class, "index"])->name('user.order');
    Route::get('/user/product/{productCode?}', [UserProductController::class, "index"])->name('user.product');

    Route::get('/user/addCart', [CartController::class, "addCart"])->name('user.addCart');

    Route::get('/user/checkout', [CartController::class, "checkoutScreen"])->name('user.checkout');
    Route::post('/user/checkout', [CartController::class, "checkout"])->name('user.checkout.post');
    Route::get('/user/checkout/success/{order_code}', [CartController::class, "checkoutSuccess"])->name('user.checkout.success');
});




//Admin:
Route::get('/admin/profile', [UserController::class, "showProfile"])->where('params', '.*')->middleware(RedirectMiddleware::class)->name('admin.profile');

Route::post('/admin/changeImage', [UserController::class, "changeImage"])->where('params', '.*')->middleware(RedirectMiddleware::class)->name('admin.change.image');
Route::post('/admin/changeProfile', [UserController::class, "changeProfile"])->where('params', '.*')->middleware(RedirectMiddleware::class)->name('admin.change.profile');
Route::post('/admin/changePassword', [UserController::class, "changePassword"])->where('params', '.*')->middleware(RedirectMiddleware::class)->name('admin.change.password');

Route::any('/admin/{params?}', [AdminController::class, "admin"])->where('params', '.*')->middleware(RedirectMiddleware::class)->name('admin_page');

Route::get('assets/{folder}/{filename}', [MainController::class, 'assetFile'])->where('folder', '.*')->name('assetFile');


//Default 404:
Route::get('/not-found', function () {
    return view('errors.404');
})->name('error.404');


//ChangeLanguage
Route::get('setActiveLang/{locale}', function ($locale) {
    $result = setActiveLang($locale);
    if ($result) return redirect()->back()->with('success', 'Language changed successfully');
    return redirect()->back()->with('success', 'An error occurred while changing the language');
})->name('Translation.setActiveLang');
