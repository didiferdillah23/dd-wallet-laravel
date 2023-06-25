<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AtmController;
use App\Http\Controllers\AccountController;


Route::get('/', [UserController::class, 'showLogin']);
Route::get('/register', [UserController::class, 'showRegister']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLogin']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::middleware('isLogin')->group(function () {
    Route::get('/home', [AtmController::class, 'showHomeScreen']);
    Route::post('/topup', [AccountController::class, 'topup']);
    Route::post('/transfer', [AccountController::class, 'transfer']);
    Route::post('/withdraw', [AccountController::class, 'withdraw']);
    Route::get('/transaction-history', [AtmController::class, 'showTransactionHistory']);
});
