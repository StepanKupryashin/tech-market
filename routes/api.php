<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('basket', [UserController::class, 'getBasket']);
});


Route::prefix('products')->group(function () {
    Route::get('', [ProductController::class, 'index']);
    Route::get('{productId}', [ProductController::class, 'detail']);
 });

Route::prefix('category')->group(function () {
   Route::get('', [CategoryController::class, 'index']);
});

Route::prefix('orders')->middleware('auth:api')->group(function () {
    Route::get('', [OrderController::class, 'index']);
    Route::post('', [OrderController::class, 'createOrder']);
    Route::get('{orderId}/warranty', [OrderController::class, 'checkWarranty']);

});
