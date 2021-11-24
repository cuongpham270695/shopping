<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
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

Route::get('/admin',[AdminController::class,'loginAdmin'])->name('admin.login');
Route::post('/admin',[AdminController::class,'postLoginAdmin'])->name('admin.post_login');

Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/',[CategoryController::class,'index'])->name('categories.list');
        Route::get('/create',[CategoryController::class,'create'])->name('categories.create');
        Route::post('/create',[CategoryController::class,'store'])->name('categories.store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
        Route::post('/edit/{id}',[CategoryController::class,'update'])->name('categories.update');
        Route::get('delete/{id}',[CategoryController::class,'destroy'])->name('categories.destroy');
    });

    Route::prefix('menus')->group(function () {
        Route::get('/',[MenuController::class,'index'])->name('menus.list');
        Route::get('/create',[MenuController::class,'create'])->name('menus.create');
        Route::post('/create',[MenuController::class,'store'])->name('menus.store');
        Route::get('/edit/{id}',[MenuController::class,'edit'])->name('menus.edit');
        Route::post('/edit/{id}',[MenuController::class,'update'])->name('menus.update');
        Route::get('delete/{id}',[MenuController::class,'destroy'])->name('menus.destroy');
    });

    Route::prefix('products')->group(function () {
        Route::get('/',[ProductController::class,'index'])->name('products.list');
        Route::get('/create',[ProductController::class,'create'])->name('products.create');
        Route::post('/create',[ProductController::class,'store'])->name('products.store');
    });
});
