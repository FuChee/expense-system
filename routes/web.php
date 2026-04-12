<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;


Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

// Category and Expense routes - protected, must be logged in
Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('expenses', ExpenseController::class);
});