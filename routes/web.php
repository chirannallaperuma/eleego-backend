<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    // vehicles routes
    Route::group(['prefix' => 'vehicles'], function () {
        Route::get('/', [\App\Http\Controllers\VehicleController::class, 'index'])->name('vehicles.index');
        Route::get('/add', [\App\Http\Controllers\VehicleController::class, 'create'])->name('vehicles.create');
        Route::post('/store', [\App\Http\Controllers\VehicleController::class, 'store'])->name('vehicles.store');
        Route::post('/update', [\App\Http\Controllers\VehicleController::class, 'update'])->name('vehicles.update');
        Route::post('/delete/{id}', [\App\Http\Controllers\VehicleController::class, 'delete'])->name('vehicles.delete');
    });

    // vehicle brands routes
    Route::group(['prefix' => 'vehicle-brands'], function () {
        Route::post('/', [\App\Http\Controllers\VehicleBrandController::class, 'store'])->name('vehicle-brand.store');
        Route::get('/', [\App\Http\Controllers\VehicleBrandController::class, 'index'])->name('vehicle-brand.index');
    });

    // bookings routes
    Route::group(['prefix' => 'bookings'], function () {
        Route::get('/{type}', [\App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
    });

    Route::get('/quotations/create', [\App\Http\Controllers\QuotationController::class, 'create'])->name('quotations.create');
    Route::post('/quotations', [\App\Http\Controllers\QuotationController::class, 'store'])->name('quotations.store');

    Route::get('/invoices/create', [\App\Http\Controllers\InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices/store', [\App\Http\Controllers\InvoiceController::class, 'store'])->name('invoices.store');
});
