<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin Dashboard
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/',[AdminController::class,'admin'])->name('admin');
});

// Banner section
Route::resource('/banner',BannerController::class);
Route::post('/banner_status',[BannerController::class,'banner_status'])->name('banner.status');

// Category section
Route::resource('/category',CategoryController::class);
Route::post('/category_status',[CategoryController::class,'category_status'])->name('category.status');