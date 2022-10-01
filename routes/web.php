<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;

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
    return redirect()->route('app.dashboard');
});

Auth::routes();

/* Route Dashboards */
Route::group(['prefix' => 'app', 'as' => 'app.', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('stations', StationController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('products', ProductController::class);
    Route::get('product/import', [ProductController::class, 'importView'])->name('products.import');
    Route::post('products', [ProductController::class, 'import'])->name('import.products');
    Route::resource('requests', RequestsController::class);
    Route::post('requests/approve/{id}', [RequestsController::class, 'approve'])->name('requests.approve');
    Route::get('requests/acknowledge/{id}', [RequestsController::class, 'acknowledge'])->name('requests.acknowledge');
    Route::resource('sales', SaleController::class);
    Route::post('sales/search', [SaleController::class,'searchItem'])->name('sales.search');
    Route::get('sales/cart/{invoice}', [SaleController::class,'cart'])->name('sales.cart');
    Route::get('sales/save/{invoice}', [SaleController::class, 'saveSale']);
    Route::get('sales/print/{invoice}', [SaleController::class, 'saveSalePrint']);
    Route::get('sales/cancel/{invoice}', [SaleController::class, 'cancelSale']);
    Route::get('sales-print/{invoice}', [SaleController::class, 'printInvoice'])->name('sales.print');
    Route::get('generalReport', [DashboardController::class, 'generalReport'])->name('general.report');
    Route::get('endOfDayReport', [DashboardController::class, 'endOfDayView'])->name('endofDay.view');
    Route::post('endDayReport', [DashboardController::class, 'endOfDayReport'])->name('endofDay.report');
    Route::get('customReport', [DashboardController::class, 'customReportView'])->name('custom.report.view');
    Route::post('customReport', [DashboardController::class, 'customReport'])->name('custom.report');
    Route::resource('settings', SettingsController::class)->except('store','update', 'edit', 'show', 'destroy');
    Route::post('settings', [SettingsController::class, 'updateStoreSettings'])->name('update.store.settings');
});

