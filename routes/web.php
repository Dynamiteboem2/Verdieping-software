<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Auth\SetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/book-lesson', [BookingController::class, 'create'])->name('book.lesson');
Route::get('/book-lesson/{lessonId}', [BookingController::class, 'createBooking'])->name('book.lesson.create');
Route::post('/book-lesson', [BookingController::class, 'store'])->name('book.lesson.store');
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/activate/{token}', [ActivationController::class, 'activate'])->name('activate');
Route::post('/activate/{token}', [SetPasswordController::class, 'setPassword'])->name('activate.setpassword');

require __DIR__.'/auth.php';
