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

Route::get('/',[IndexController::class,'home'])->name('home');


// product category
Route::get('/product-category/{slug}/',[IndexController::class,'ProductCategory'])->name('product.category');
//product detail
Route::get('/product-detail/{slug}',[IndexController::class,'productDetail'])->name('product.detail');

//Frontend end section



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin Dashboard
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
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

