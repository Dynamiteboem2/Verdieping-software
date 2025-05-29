<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Auth\SetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::get('/activate/{token}', [ActivationController::class, 'activate'])->name('activate');
Route::post('/activate/{token}', [SetPasswordController::class, 'setPassword'])->name('activate.setpassword');

Route::get('/check-email', function () {
    return view('auth.check-email');
})->name('check-email');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/{user}/role', [AdminController::class, 'updateRole'])->name('admin.updateRole');
    Route::post('/admin/users/{user}/update', [AdminController::class, 'updateUser'])->name('admin.updateUser');
});

Route::middleware(['auth', 'instructor'])->group(function () {
    Route::get('/instructor/profile', [InstructorController::class, 'editProfile'])->name('instructor.editProfile');
    Route::post('/instructor/profile', [InstructorController::class, 'updateProfile'])->name('instructor.updateProfile');
    Route::post('/instructor/bookings/{booking}/cancel', [InstructorController::class, 'cancelBooking'])->name('instructor.cancelBooking');
    Route::get('/instructor/customers', [InstructorController::class, 'customers'])->name('instructor.customers');
});

Route::get('/dashboard-tiles', function () {
    return view('dashboard-tiles');
})->middleware(['auth'])->name('dashboard.tiles');

Route::get('/admin', [AdministratorController::class, 'index']);

require __DIR__.'/auth.php';
