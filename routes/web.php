<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Frontend section

// authentication
Route::get('/user/auth',[IndexController::class,'UserAuth'])->name('user.auth')->middleware('guest');

Route::post('/user/login',[IndexController::class,'loginSubmit'])->name('login.submit');
//register
Route::post('/user/register',[IndexController::class,'registerSubmit'])->name('register.submit');
Route::get('/user/logout',[IndexController::class,'LogoutSubmit'])->name('logout.submit');
//Route::post('/user/logout',[IndexController::class,'userLogout'])->name('user.logout');


Route::get('/',[IndexController::class,'home'])->name('user.home');


// product category
Route::get('/product-category/{slug}/',[IndexController::class,'ProductCategory'])->name('product.category');

//Product load of category
Route::get('/load-product/{slug}',[IndexController::class,'loadProduct'])->name('load.product');

//product detail
Route::get('/product-detail/{slug}',[IndexController::class,'productDetail'])->name('product.detail');

//Frontend end section



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin Dashboard
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
    Route::get('/',[AdminController::class,'admin'])->name('admin');
    // Banner section
    Route::resource('/banner',BannerController::class);
    Route::post('/banner_status',[BannerController::class,'banner_status'])->name('banner.status');

    // Category section
    Route::resource('/category',CategoryController::class);
    Route::post('/category_status',[CategoryController::class,'category_status'])->name('category.status');

    Route::post('/category/child/{id}',[CategoryController::class,'getChildByParentID'])->name('category.child');

    //brand section
    Route::resource('/brand',BrandController::class);
    Route::post('/brand_status',[BrandController::class,'brand_status'])->name('brand.status');

    //Product section
    Route::resource('/product',ProductController::class);
    Route::post('/product_status',[ProductController::class,'product_status'])->name('product.status');

    //user section
    Route::resource('/user',UserController::class);
    Route::post('/user_status',[UserController::class,'user_status'])->name('user.status');

});

//seller
Route::group(['prefix'=>'seller','middleware'=>['auth','seller']],function(){
    Route::get('/',[AdminController::class,'admin'])->name('seller');

});
//  User dhasboard
Route::middleware('auth')->group(function (){

Route::group(['prefix'=>'user','middleware'=>['auth','user']],function (){
    Route::get('/dashboard',[IndexController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/order',[IndexController::class,'userOrder'])->name('user.order');
    Route::get('/address',[IndexController::class,'userAddress'])->name('user.address');
    Route::get('/account-details',[IndexController::class,'userAccount'])->name('user.account');
    //billing Address
    Route::post('/billing/address/{id}',[IndexController::class,'billingAddress'])->name('billing.address');
    //shipping address
    Route::post('/shipping/address/{id}',[IndexController::class,'shippingAddress'])->name('shipping.address');
    Route::post('/update/account/{id}',[IndexController::class,'updateAccount'])->name('update.account');
});

});
