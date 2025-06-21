<?php

use App\Http\Controllers\BackendController\CategoryController;
use App\Http\Controllers\BackendController\ProductController;
use App\Http\Controllers\BackendController\UserController;
use App\Http\Controllers\FrontController\ProductController as FrontControllerProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(FrontControllerProductController::class)->group(function(){
   Route::get('/','home');
   Route::get('/shop','shop')->name('shop');
});


Route::get('/news', function () {
    return view('Frontend.news');
});


Route::controller(UserController::class)->group(function(){
    Route::get('/login','login')->name('login');
    Route::get('/register','register')->name('register');
    Route::post('/signup-submit','signupSubmit')->name('signupSubmit');
    Route::post('/loginSubmit','loginSubmit')->name('loginSubmit');
    Route::get('/logout','logout')->name('logout');
});
Route::get('/admin/dashboard', [UserController::class, 'dashBoard'])
    ->middleware('auth')
    ->name('dashBoard');
Route::middleware(['auth'])->group(function(){
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/add-product','addProduct')->name('addProduct');
        Route::post('/admin/add-product-submit','addProductSubmit')->name('addProductSubmit');
        Route::get('/admin/list-product','listProduct');
        Route::post('/admin/delete-product','deleteProduct')->name('deleteProduct');
        Route::get('/admin/edit-product/{product}','editProduct')->name('editProduct');
    });
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/add-category','addCategory')->name('addCategory');
        Route::post('/admin/add-category-submit','addCateSubmit')->name('addCateSubmit');
        Route::get('/admin/list-category','viewCate')->name('viewCate');
        Route::get('/admin/edit-category/{category}','editCate')->name('editCategory');
        Route::post('/admin/delete-category','deleteCate')->name('deleteCate');
    });
});
