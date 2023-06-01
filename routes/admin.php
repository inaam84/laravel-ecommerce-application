<?php

use App\Http\Controllers\Admin\LoginController;
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

