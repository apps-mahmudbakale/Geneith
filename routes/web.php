<?php

use App\Classes\CustomReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReturnSaleController;

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

Route::get('/test', function (){
    $report = new CustomReport();
    return $report->monthlyReport();

});
Route::get('syncData', [SaleController::class, 'store']);
Route::get('syncStore', [SaleController::class, 'syncStore']);
Route::post('synced', [SaleController::class, 'synced']);

Auth::routes();

/* Route Dashboards */
Route::group(['prefix' => 'app', 'as' => 'app.', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('sync', [DashboardController::class, 'sync'])->name('sync');
    Route::resource('users', UserController::class);
    Route::post('reset-password/{id}', [UserController::class, 'resetPassword'])->name('users.reset');
    Route::get('reset-password/{id}', [UserController::class, 'resetPasswordView'])->name('reset-password');
    Route::resource('roles', RoleController::class);
    Route::resource('stations', StationController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('products', ProductController::class);
    Route::get('product/import', [ProductController::class, 'importView'])->name('products.import');
    Route::get('product/import-special', [ProductController::class, 'importSpecialView'])->name('products.import-special-view');
    Route::get('product/print', [ProductController::class, 'print'])->name('products.print');
    Route::post('products/imports', [ProductController::class, 'import'])->name('import.products');
    Route::post('product/imports-special', [ProductController::class, 'importSpecial'])->name('import-special.products');
    Route::get('product/export', [ProductController::class, 'export'])->name('export.products');
    Route::resource('requests', RequestsController::class);
    Route::post('requests/approve/{id}', [RequestsController::class, 'approve'])->name('requests.approve');
    Route::get('requests/acknowledge/{id}', [RequestsController::class, 'acknowledge'])->name('requests.acknowledge');
    Route::resource('sales', SaleController::class);
    Route::post('sales/search', [SaleController::class,'searchItem'])->name('sales.search');
    Route::get('sales/cart/{invoice}', [SaleController::class,'cart'])->name('sales.cart');
    Route::resource('returns', ReturnSaleController::class);
    Route::post('returns/approve', [ReturnSaleController::class, 'approve'])->name('returns.approve');
    Route::get('sales/save/{invoice}', [SaleController::class, 'saveSale']);
    Route::get('sales/print/{invoice}', [SaleController::class, 'saveSalePrint']);
    Route::get('sales/cancel/{invoice}', [SaleController::class, 'cancelSale']);
    Route::get('sales-print/{invoice}', [SaleController::class, 'printInvoice'])->name('sales.print');
    Route::get('generalReport', [DashboardController::class, 'generalReport'])->name('general.report');
    Route::get('changePassword', [DashboardController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('changePassword', [DashboardController::class, 'changePasswordPost'])->name('changePasswordPost');
    Route::get('endOfDayReport', [DashboardController::class, 'endOfDayView'])->name('endofDay.view');
    Route::post('endDayReport', [DashboardController::class, 'endOfDayReport'])->name('endofDay.report');
    Route::get('customReport', [DashboardController::class, 'customReportView'])->name('custom.report.view');
    Route::get('monthlyReport', [DashboardController::class, 'monthlyReportView'])->name('monthly.report.view');
    Route::post('monthlyReport', [DashboardController::class, 'monthlyReport'])->name('monthly.report.download');
    Route::post('customReport', [DashboardController::class, 'customReport'])->name('custom.report');
    Route::resource('invoices', InvoiceController::class);
    Route::resource('settings', SettingsController::class)->except('store','update', 'edit', 'show', 'destroy');
    Route::post('settings', [SettingsController::class, 'updateStoreSettings'])->name('update.store.settings');
    Route::post('settings/currency', [SettingsController::class, 'updateStoreCurrency'])->name('update.store.currency');
    Route::get('request/exports-all', [RequestsController::class, 'exportsAll'])->name('requests.exports.all');
    Route::get('request/exports-one/{ref}', [RequestsController::class, 'exportsOne'])->name('requests.exports.one');
    Route::get('request/import-view', [RequestsController::class, 'importView'])->name('requests.import.view');
    Route::post('request/import', [RequestsController::class, 'import'])->name('request.import');
});

