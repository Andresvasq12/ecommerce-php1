<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderApiController;
use App\Http\Controllers\OrderApi2Controllers;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('product', [ProductApiController::class, 'index']);
Route::get('product/{id}', [ProductApiController::class, 'getById']);

Route::post('oauth/token', 'Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

//Route::post('order', [OrderApiController::class, 'store']);
Route::post('product', [ProductApiController::class, 'store']);

Route::post('order', [OrderApi2Controllers::class, 'store']);
Route::get('order/{email}', [OrderApi2Controllers::class, 'index']);
