<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

// /admin/ applies to for all routes

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth:admin']], function(){
    Route::get('/', function(){
        return view('admin.dashboard.index');
    })->name('dashboard.index');

});

Route::group(['prefix' => 'brands'], function() {
    Route::get('/', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/store', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('/update', [BrandController::class, 'update'])->name('brands.update');
    Route::get('/{id}/delete', [BrandController::class, 'delete'])->name('brands.delete');
});
