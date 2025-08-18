<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', fn () => view('welcome'));
Route::get('/register',[AuthController::class,'show_register'])->name('register');
Route::get('/login',[AuthController::class,'show_login'])->name('login');

// Register & login routes
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Protected routes (require login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[AuthController::class,'show_dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/add-funds',[ClientController::class,'add_funds'])->name('addfunds');
    Route::post('/transactions/add-funds', [ClientController::class, 'add_funds'])->name('transactions.addFunds');
    Route::post('/transactions/make', [ClientController::class, 'make_transaction'])->name('transactions.make');

    Route::get('/account-details',[ClientController::class,'account_details'])->name('account-details');
});
