<?php

use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ShippingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\CouponContoller;

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

//cart section
Route::get('cart',[CartController::class,'cart'])->name('cart');
Route::post('cart/store',[CartController::class,'cartStore'])->name('cart.store');
Route::post('cart/delete',[CartController::class,'cartDelete'])->name('cart.delete');
Route::post('cart/update',[CartController::class,'cartUpdate'])->name('cart.update');

//coupon section
Route::post('/coupon/add',[CartController::class,'couponAdd'])->name('coupon.add');

//wishlist section
Route::get('wishlist/',[WishlistController::class,'wishlist'])->name('wishlist');
Route::post('wishlist/store',[WishlistController::class,'wishlistStore'])->name('wishlist.store');
Route::post('wishlist/move-to-cart',[WishlistController::class,'moveToCart'])->name('wishlist.move.cart');
Route::post('wishlist/delete',[WishlistController::class,'wishlistDelete'])->name('wishlist.delete');

// checkout Controller
 Route::get("checkout1/",[CheckoutController::class,'checkout1'])->name('checkout1')->middleware('user');
 Route::post("checkout-first/",[CheckoutController::class,'checkout1Store'])->name('checkout1.store');
 Route::post("checkout-second/",[CheckoutController::class,'checkout2Store'])->name('checkout2.store');
 Route::post("checkout-third/",[CheckoutController::class,'checkout3Store'])->name('checkout3.store');
 Route::get("checkout-store",[CheckoutController::class,'checkoutStore'])->name('checkout.store');
 Route::get("checkout-complete/{order}",[CheckoutController::class,'checkoutComplete'])->name('checkout.complete');

 //shop
Route::get('shop/',[IndexController::class,'shop'])->name('shop');
Route::post('shop-filter/',[IndexController::class,'shopFilter'])->name('shop.filter');



 //Frontend end section



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('admin');

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

    //Coupon section
    Route::resource('/coupon',CouponContoller::class);
    Route::post('/coupon_status',[CouponContoller::class,'coupon_status'])->name('coupon.status');

    //shipping section
    Route::resource('/shipping',ShippingController::class);
    Route::post('/shipping_status',[ShippingController::class,'shipping_status'])->name('shipping.status');


});

//seller
Route::group(['prefix'=>'seller','middleware'=>['auth','seller']],function(){
    Route::get('/',[AdminController::class,'admin'])->name('seller');

});
//  User dhasboard
//Route::middleware('auth')->group(function (){

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

//});
