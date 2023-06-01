<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// /admin/ applies to for all routes

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth:admin']], function(){
    Route::get('/', function(){
        return view('admin.dashboard.index');
    })->name('dashboard');

});

Route::group(['prefix' => 'brands'], function() {
    Route::get('/', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/store', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('/update', [BrandController::class, 'update'])->name('brands.update');
    Route::get('/{id}/delete', [BrandController::class, 'delete'])->name('brands.delete');
});

Route::group(['prefix' => 'categories'], function() {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/{id}/delete', [CategoryController::class, 'delete'])->name('categories.delete');
});
