<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\AttendanceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', [AuthController::class, 'login']);

//logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//get company
Route::get('/company', [CompanyController::class, 'index'])->middleware('auth:sanctum');

// check in
Route::post('/checkin', [AttendanceController::class, 'checkin'])->middleware('auth:sanctum');

// checkout
Route::post('/checkout', [AttendanceController::class, 'checkout'])->middleware('auth:sanctum');

// is checkin
Route::get('/is-checkin', [AttendanceController::class, 'isCheckedIn'])->middleware('auth:sanctum');

// update profile
Route::post('/update-profile', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');

