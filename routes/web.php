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
| Bao gồm phần người dùng, xác thực (login/register/logout),
| và khu vực quản trị (admin) với middleware 'isAdmin'.
|--------------------------------------------------------------------------
*/

// -------------------------
// 👥 PHẦN NGƯỜI DÙNG (USER)
// -------------------------

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Trang sách (user)
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Giỏ hàng (user)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


// -------------------------
// 🔐 ĐĂNG NHẬP / ĐĂNG KÝ / LOGOUT
// -------------------------

// Hiển thị form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Xử lý login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Hiển thị form register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Xử lý register
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// -------------------------
// ⚙️ PHẦN QUẢN TRỊ (ADMIN)
// -------------------------
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {

    // Trang chính Admin
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    // Quản lý Sách (Books) - CRUD
    Route::resource('books', AdminBookController::class)->except(['show']);

    // Quản lý Danh mục (Categories) - CRUD
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
});
