<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Expense;
use App\Http\Controllers\UserController;


Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/home', function () {
    $categoryCount = Category::where('user_id', auth()->id())->count();
    $totalExpenses = Expense::where('user_id', Auth::id())->sum('amount');
    $thisMonthExpenses = Expense::where('user_id', Auth::id())
        ->whereMonth('transaction_date', now()->month)
        ->whereYear('transaction_date', now()->year)
        ->sum('amount');
    return view('home', compact('categoryCount', 'totalExpenses', 'thisMonthExpenses'));
})->middleware('auth');

Route::get('/categories', [CategoryController::class, 'index'])->middleware('auth');
Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->middleware('auth');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware('auth');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->middleware('auth');

Route::get('/expenses/index', [ExpenseController::class, 'index'])->middleware('auth');
Route::get('/expenses/create', [ExpenseController::class, 'create'])->middleware('auth');
Route::post('/expenses', [ExpenseController::class, 'store'])->middleware('auth');
Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->middleware('auth');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->middleware('auth');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->middleware('auth');

Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});
