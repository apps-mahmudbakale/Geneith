<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SaleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('getPrice', [SaleController::class, 'getPrice']);
Route::get('getSales/{station}', [SaleController::class, 'getSales']);
Route::get('getProducts', [SaleController::class, 'getProducts']);
Route::post('updateSale', [SaleController::class, 'update']);
Route::post('stationProducts', [SaleController::class, 'stationProducts']);
Route::get('request', [SaleController::class, 'requests']);
Route::post('syncProducts', [SaleController::class, 'syncProducts']);
