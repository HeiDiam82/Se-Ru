<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RukoController;
use App\Http\Controllers\AdminController;
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

// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    // Overview Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Ruko Management
    Route::get('/ruko', [RukoController::class, 'adminIndex'])->name('ruko.index');
    Route::post('/ruko', [RukoController::class, 'store'])->name('ruko.store');
    Route::get('/ruko/{ruko}/edit', [RukoController::class, 'edit'])->name('ruko.edit');
    Route::post('/ruko/{ruko}', [RukoController::class, 'update'])->name('ruko.update');
    Route::post('/ruko/{ruko}/delete', [RukoController::class, 'destroy'])->name('ruko.destroy');

    // Booking Management
    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'adminShow'])->name('bookings.show');
    Route::post('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.status');
});
