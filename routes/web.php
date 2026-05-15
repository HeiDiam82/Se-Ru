<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RukoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredRukos = \App\Models\Ruko::where('status', 'available')->take(3)->get();
    return view('welcome', compact('featuredRukos'));
});

// Auth Routes
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Catalog
Route::get('/katalog', [RukoController::class, 'index'])->name('katalog');
Route::get('/ruko/{ruko}', [RukoController::class, 'show'])->name('ruko.show');

Route::middleware('auth')->group(function () {
    // User Dashboard & Booking
    Route::get('/dashboard', [BookingController::class, 'userDashboard'])->name('dashboard');
    Route::post('/book', [BookingController::class, 'store'])->name('book.store');
});

// Admin Routes (Quick implementation checking role)
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [BookingController::class, 'adminIndex'])->name('dashboard');
    Route::resource('ruko', RukoController::class)->except(['index', 'show']);
    Route::get('/ruko', [RukoController::class, 'adminIndex'])->name('ruko.index');
    Route::post('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.status');
});
