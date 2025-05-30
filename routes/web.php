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
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\InvoiceController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/address', [ProfileController::class, 'updateAddress'])->name('profile.update.address');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/book-lesson', [BookingController::class, 'create'])->name('book.lesson');
Route::get('/book-lesson/{lessonId}', [BookingController::class, 'createBooking'])->name('book.lesson.create');
Route::post('/book-lesson', [BookingController::class, 'store'])->name('book.lesson.store');
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking/{id}/mark-paid', [BookingController::class, 'markPaid'])->name('booking.markPaid');
Route::post('/booking/{id}/make-definitief', [BookingController::class, 'makeDefinitief'])->name('booking.makeDefinitief');
Route::post('/booking/{id}/cancel', [\App\Http\Controllers\BookingController::class, 'cancel'])->name('booking.cancel');
Route::post('/booking/{id}/approve-cancellation', [BookingController::class, 'approveCancellation'])->name('booking.approveCancellation');
Route::get('/booking/{id}/ideal', [BookingController::class, 'ideal'])->name('booking.ideal');
Route::post('/booking/{id}/ideal-pay', [BookingController::class, 'idealPay'])->name('booking.ideal.pay');

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
    Route::get('/admin/bookings', [App\Http\Controllers\AdminController::class, 'bookings'])->name('admin.bookings');
    Route::post('/admin/bookings/{booking}/notify', [AdminController::class, 'notifyBooking'])->name('admin.bookings.notify');
    Route::get('/admin/invoices', [InvoiceController::class, 'index'])->name('admin.invoices');
    Route::get('/admin/payments', [InvoiceController::class, 'index'])->name('admin.payments');
    Route::post('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.createUser');
});

Route::middleware(['auth', 'instructor'])->group(function () {
    Route::get('/instructor/profile', [InstructorController::class, 'editProfile'])->name('instructor.editProfile');
    Route::post('/instructor/profile', [InstructorController::class, 'updateProfile'])->name('instructor.updateProfile');
    Route::post('/instructor/bookings/{booking}/cancel', [InstructorController::class, 'cancelBooking'])->name('instructor.cancelBooking');
    Route::get('/instructor/customers', [InstructorController::class, 'customers'])->name('instructor.customers');
    Route::post('/instructor/customers/{booking}/cancel', [InstructorController::class, 'cancelBooking'])->name('instructor.cancelBooking');
    Route::get('/instructor/customers/{booking}/edit', [InstructorController::class, 'editBooking'])->name('instructor.editBooking');
    Route::post('/instructor/customers/{booking}/update', [InstructorController::class, 'updateBooking'])->name('instructor.updateBooking');
    Route::delete('/instructor/customers/{booking}', [InstructorController::class, 'destroyBooking'])->name('instructor.destroyBooking');
    Route::get('/instructor/overview/day', [\App\Http\Controllers\InstructorController::class, 'dayOverview'])->name('instructor.overview.day');
    Route::get('/instructor/overview/week', [\App\Http\Controllers\InstructorController::class, 'weekOverview'])->name('instructor.overview.week');
    Route::get('/instructor/overview/month', [\App\Http\Controllers\InstructorController::class, 'monthOverview'])->name('instructor.overview.month');
});

Route::get('/dashboard-tiles', function () {
    return view('dashboard-tiles');
})->middleware(['auth'])->name('dashboard.tiles');

Route::post('/user/complete-profile', [UserController::class, 'completeProfile'])->name('user.completeProfile');

Route::get('/admin', [AdministratorController::class, 'index']);
Route::get('/klant/boekingen', [DashboardController::class, 'allBookings'])->name('klant.allBookings');

require __DIR__.'/auth.php';
