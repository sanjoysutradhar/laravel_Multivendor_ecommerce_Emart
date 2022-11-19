<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductReviewController;
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



//Admin
Route::group(['prefix'=>'admin'],function (){
    Route::get('login/',[\App\Http\Controllers\Auth\Admin\LoginController::class,'showLoginForm'])->name('admin.login.form');
    Route::post('login/',[\App\Http\Controllers\Auth\Admin\LoginController::class,'login'])->name('admin.login');
});
//Admin Dashboard
//Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
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

    //product attribute section
    Route::post('product-attribute/{id}',[ProductController::class,'addProductAttribute'])->name('product.attribute');
    Route::delete('product-attribute-destroy/{id}',[ProductController::class,'destroyProductAttribute'])->name('product.attribute.destroy');

    // product review
    Route::post('product-review/{slug}',[ProductReviewController::class,'productReview'])->name('product.review');

    //user section
    Route::resource('/user',UserController::class);
    Route::post('/user_status',[UserController::class,'user_status'])->name('user.status');

    //Coupon section
    Route::resource('/coupon',CouponContoller::class);
    Route::post('/coupon_status',[CouponContoller::class,'coupon_status'])->name('coupon.status');

    //shipping section
    Route::resource('/shipping',ShippingController::class);
    Route::post('/shipping_status',[ShippingController::class,'shipping_status'])->name('shipping.status');
    // order section
    Route::resource('order',OrderController::class);
    Route::post('/order/status',[OrderController::class,'orderStatus'])->name('order.status');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('admin');

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
