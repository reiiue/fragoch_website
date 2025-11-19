<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminAuthController;

require __DIR__.'/auth.php';

// --------------------------
// Landing Page
// --------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// --------------------------
// Room Details
// --------------------------
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');


// --------------------------
// Booking (requires user login)
// --------------------------
Route::middleware(['auth:web,admin'])->group(function () {

    Route::get('/book/{room}', [BookingController::class, 'create'])->name('book.create');
    Route::post('/book', [BookingController::class, 'store'])->name('book.store');
    Route::get('/booking/confirmation/{booking}', [BookingController::class, 'confirmation'])->name('booking.confirmation');


    Route::get('/payment/{booking}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{booking}', [PaymentController::class, 'store'])->name('payment.store');
});

// --------------------------
// Unified Login & Logout
// --------------------------
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Register Routes
Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.submit');


// --------------------------
// Admin Routes (protected)
// --------------------------
Route::middleware('auth:admin')->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Rooms Management
    Route::get('/rooms', [AdminRoomController::class, 'index'])->name('admin.rooms.index');
    Route::get('/rooms/create', [AdminRoomController::class, 'create'])->name('admin.rooms.create');
    Route::post('/rooms/store', [AdminRoomController::class, 'store'])->name('admin.rooms.store');

        // Marketing & Bookings
    Route::get('/booking/marketing', function () {
        return view('admin.booking.marketing_booking'); // Blade file path
    })->name('admin.marketing-booking');

     // Sustainability Tracker
    Route::prefix('sustainability')->group(function () {
        Route::get('/', function () {
            return view('admin.sustainability.sustainability_tracker'); // Blade file path
        })->name('admin.sustainability-tracker');
    });

        // Task Board
    Route::prefix('tasks')->group(function () {
        Route::get('/', function () {
            return view('admin.tasks.taskboard'); // Blade file path
        })->name('admin.task-board');
    });

        // Guest Feedback
    Route::prefix('guests')->group(function () {
        Route::get('/guest_feedback', function () {
            return view('admin.guests.guest_feedback'); // Blade file path for guest feedback
        })->name('admin.guests.guest-feedback');
    });

    // Employee Management
    Route::prefix('admin/employees')->group(function () {
        Route::get('/', function () {
            return view('admin.employee.index'); // your Blade file
        })->name('admin.employees.index');
    });

    // Sales & Revenue Dashboard
    Route::get('/sales-revenue', function () {
        return view('admin.sales.sales_revenue'); // Blade path: admin/sales/sales_revenue.blade.php
    })->name('admin.sales.sales-revenue');

    

    
    // Edit room
    Route::get('/rooms/{room}/edit', [AdminRoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::put('/rooms/{room}', [AdminRoomController::class, 'update'])->name('admin.rooms.update');

    // Delete room
    Route::delete('/rooms/{room}', [AdminRoomController::class, 'destroy'])->name('admin.rooms.destroy');

    // Admin Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

