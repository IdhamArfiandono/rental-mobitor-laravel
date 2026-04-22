<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\CatalogController;
use App\Http\Controllers\Public\VehicleDetailController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Customer\RentalController as CustomerRental;
use App\Http\Controllers\Customer\ProfileController as CustomerProfile;
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;
use App\Http\Controllers\Staff\RentalController as StaffRental;
use App\Http\Controllers\Staff\PaymentController as StaffPayment;
use App\Http\Controllers\Staff\VehicleController as StaffVehicle;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\VehicleController as AdminVehicle;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\ReportController as AdminReport;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{vehicle}', [VehicleDetailController::class, 'show'])->name('catalog.show');

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// Redirect setelah login berdasarkan role
Route::get('/dashboard', function () {
    return match(auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'staff' => redirect()->route('staff.dashboard'),
        default => redirect()->route('customer.dashboard'),
    };
})->middleware('auth')->name('dashboard');

// Customer routes
Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('dashboard');
    Route::resource('/rentals', CustomerRental::class)->only(['index', 'create', 'store', 'show', 'destroy']);
    Route::get('/profile', [CustomerProfile::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [CustomerProfile::class, 'update'])->name('profile.update');
});

// Staff routes
Route::prefix('staff')->name('staff.')->middleware(['auth', 'role:staff,admin'])->group(function () {
    Route::get('/dashboard', [StaffDashboard::class, 'index'])->name('dashboard');
    Route::resource('/rentals', StaffRental::class)->only(['index', 'show', 'edit', 'update']);
    Route::post('/rentals/{rental}/extend', [StaffRental::class, 'extend'])->name('rentals.extend');
    Route::post('/rentals/{rental}/damage', [StaffRental::class, 'damage'])->name('rentals.damage');
    Route::get('/payments', [StaffPayment::class, 'index'])->name('payments.index');
    Route::post('/payments/{payment}/confirm', [StaffPayment::class, 'confirm'])->name('payments.confirm');
    Route::get('/payments/{payment}/receipt', [StaffPayment::class, 'receipt'])->name('payments.receipt');
    Route::get('/vehicles', [StaffVehicle::class, 'index'])->name('vehicles.index');
    Route::post('/vehicles/{vehicle}/status', [StaffVehicle::class, 'updateStatus'])->name('vehicles.status');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('/vehicles', AdminVehicle::class);
    Route::resource('/users', AdminUser::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/reports', [AdminReport::class, 'index'])->name('reports.index');
});
