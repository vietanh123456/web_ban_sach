<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Phần người dùng, xác thực, và khu vực quản trị.
|--------------------------------------------------------------------------
*/

// -------------------------
// 👥 USER
// -------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Giỏ hàng (khớp với view dùng PUT/DELETE)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');     // cập nhật số lượng
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');  // xoá 1 item
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');         // xoá hết

// -------------------------
// 🔐 AUTH
// -------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// -------------------------
// ⚙️ ADMIN
// -------------------------
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::view('/', 'admin.index')->name('index');
        Route::resource('books', AdminBookController::class)->except(['show']);
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
    });
