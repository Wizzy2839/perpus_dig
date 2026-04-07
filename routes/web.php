<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

use App\Models\Book;

// Halaman utama — tampilkan welcome, redirect ke dashboard jika sudah login
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('student.dashboard');
    }
    $featuredBooks = Book::with('category')->latest()->take(5)->get();
    return view('welcome', compact('featuredBooks'));
})->name('home');

/*
|--------------------------------------------------------------------------
| Auth Routes (hanya untuk tamu / belum login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Buku
    Route::resource('books', Admin\BookController::class)->except(['show']);

    // Kategori
    Route::resource('categories', Admin\CategoryController::class)->only(['index', 'store', 'update', 'destroy']);

    // Anggota
    Route::resource('members', Admin\MemberController::class)->except(['create', 'edit']);
    Route::patch('/members/{member}/toggle-active', [Admin\MemberController::class, 'toggleActive'])->name('members.toggle-active');

    // Peminjaman
    Route::get('/loans', [Admin\LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [Admin\LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [Admin\LoanController::class, 'store'])->name('loans.store');
    Route::get('/loans/{loan}', [Admin\LoanController::class, 'show'])->name('loans.show');
    Route::patch('/loans/{loan}/approve', [Admin\LoanController::class, 'approve'])->name('loans.approve');
    Route::patch('/loans/{loan}/reject', [Admin\LoanController::class, 'reject'])->name('loans.reject');
    Route::patch('/loans/{loan}/return', [Admin\LoanController::class, 'returnBook'])->name('loans.return');

    // Laporan
    Route::get('/reports', [Admin\ReportController::class, 'index'])->name('reports.index');
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::prefix('student')->name('student.')->middleware(['auth', 'role:murid'])->group(function () {

    Route::get('/dashboard', [Student\DashboardController::class, 'index'])->name('dashboard');

    // Katalog buku
    Route::get('/catalog', [Student\CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/{book}', [Student\CatalogController::class, 'show'])->name('catalog.show');

    // Peminjaman
    Route::get('/loans', [Student\LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [Student\LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [Student\LoanController::class, 'store'])->name('loans.store');

    // Profil
    Route::get('/profile', [Student\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [Student\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [Student\ProfileController::class, 'changePassword'])->name('profile.password');
});

/*
|--------------------------------------------------------------------------
| Fallback — halaman tidak ditemukan
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return redirect()->route('home');
});