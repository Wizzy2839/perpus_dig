<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');

Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Books
    Route::resource('books', Admin\BookController::class)->except(['show']);

    // Categories
    Route::get('/categories', [Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

    // Members
    Route::get('/members', [Admin\MemberController::class, 'index'])->name('members.index');
    Route::post('/members', [Admin\MemberController::class, 'store'])->name('members.store');
    Route::get('/members/{member}', [Admin\MemberController::class, 'show'])->name('members.show');
    Route::put('/members/{member}', [Admin\MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{member}', [Admin\MemberController::class, 'destroy'])->name('members.destroy');
    Route::patch('/members/{member}/toggle-active', [Admin\MemberController::class, 'toggleActive'])->name('members.toggle-active');

    // Loans
    Route::get('/loans', [Admin\LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [Admin\LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [Admin\LoanController::class, 'store'])->name('loans.store');
    Route::get('/loans/{loan}', [Admin\LoanController::class, 'show'])->name('loans.show');
    Route::patch('/loans/{loan}/approve', [Admin\LoanController::class, 'approve'])->name('loans.approve');
    Route::patch('/loans/{loan}/reject', [Admin\LoanController::class, 'reject'])->name('loans.reject');
    Route::patch('/loans/{loan}/return', [Admin\LoanController::class, 'returnBook'])->name('loans.return');

    // Reports
    Route::get('/reports', [Admin\ReportController::class, 'index'])->name('reports.index');
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::prefix('student')->name('student.')->middleware(['auth', 'role:murid'])->group(function () {

    Route::get('/dashboard', [Student\DashboardController::class, 'index'])->name('dashboard');

    // Catalog
    Route::get('/catalog', [Student\CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/{book}', [Student\CatalogController::class, 'show'])->name('catalog.show');

    // Loans
    Route::get('/loans', [Student\LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [Student\LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [Student\LoanController::class, 'store'])->name('loans.store');

    // Profile
    Route::get('/profile', [Student\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [Student\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [Student\ProfileController::class, 'changePassword'])->name('profile.password');
});
