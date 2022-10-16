<?php

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
Route::get('syncData', [SaleController::class, 'store']);
Route::get('syncStore', [SaleController::class, 'syncStore']);
Route::post('synced', [SaleController::class, 'synced']);
// Route::get('db_dump', function () {
//     /*
//     Needed in SQL File:

//     SET GLOBAL sql_mode = '';
//     SET SESSION sql_mode = '';
//     */
//     $get_all_table_query = "SHOW TABLES";
//     $result = DB::select(DB::raw($get_all_table_query));

//     $tables = [
//         'users',
//         'products',
//         'stores',
//         'migrations',
//     ];

//     $structure = '';
//     $data = '';
//     foreach ($tables as $table) {
//         $show_table_query = "CREATE TABLE IF NOT EXISTS " . $table . "";

//         $show_table_result = DB::select(DB::raw($show_table_query));

//         foreach ($show_table_result as $show_table_row) {
//             $show_table_row = (array)$show_table_row;
//             $structure .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
//         }
//         $select_query = "SELECT * FROM " . $table;
//         $records = DB::select(DB::raw($select_query));

//         foreach ($records as $record) {
//             $record = (array)$record;
//             $table_column_array = array_keys($record);
//             foreach ($table_column_array as $key => $name) {
//                 $table_column_array[$key] = '`' . $table_column_array[$key] . '`';
//             }

//             $table_value_array = array_values($record);
//             $data .= "\nINSERT INTO $table (";

//             $data .= "" . implode(", ", $table_column_array) . ") VALUES \n";

//             foreach($table_value_array as $key => $record_column)
//                 $table_value_array[$key] = addslashes($record_column);

//             $data .= "('" . implode("','", $table_value_array) . "');\n";
//         }
//     }
//     $file_name = __DIR__ . '/../database/database_backup_on_' . date('y_m_d') . '.sql';
//     $file_handle = fopen($file_name, 'w + ');

//     $output = $structure . $data;
//     fwrite($file_handle, $output);
//     fclose($file_handle);
//     echo "DB backup ready";
// });

// Route::get('db_import', function () {
//     DB::unprepared(file_get_contents('../database/database_backup_on_22_10_04.sql'));
//     // $sql_dump = File::get('../database/database_backup_on_22_10_04.sql');
//     // DB::connection()->getPdo()->exec($sql_dump);
// });

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
    Route::post('products/imports', [ProductController::class, 'import'])->name('import.products');
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
    Route::post('customReport', [DashboardController::class, 'customReport'])->name('custom.report');
    Route::resource('invoices', InvoiceController::class);
    Route::resource('settings', SettingsController::class)->except('store','update', 'edit', 'show', 'destroy');
    Route::post('settings', [SettingsController::class, 'updateStoreSettings'])->name('update.store.settings');
    Route::post('settings/currency', [SettingsController::class, 'updateStoreCurrency'])->name('update.store.currency');
});

