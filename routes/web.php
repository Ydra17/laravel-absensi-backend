<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return view('pages.auth.auth-login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function(){
        return view('pages.dashboard', ['type_menu' => 'dashboard']);
    })->name('home');

    Route::resource('users', UserController::class);
    Route::resource('company', CompanyController::class);
});
