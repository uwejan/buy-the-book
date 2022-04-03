<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RecommendController;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/// User Service
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    // Un-protected by middleware
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',  [AuthController::class, 'login']);

    // Protected by middleware
    Route::post('logout',  [AuthController::class, 'logout']);
    Route::post('refresh',  [AuthController::class, 'refresh']);
    Route::post('me',  [AuthController::class, 'me']);

});

/// Recommendation Service
Route::group([
   // 'middleware' => 'api',    /// Only enable to protect routes against login
    'prefix' => 'recommend'
], function ($router) {

    Route::get('cheapest', [RecommendController::class, 'cheapest']);
    Route::get('cheapest/kind/{kind}', [RecommendController::class, 'cheapestByKind']);

});


/// Stock Service
Route::group([
    // 'middleware' => 'api',    /// Only enable to protect routes against login
    'prefix' => 'stocks'
], function ($router) {
    Route::get('all', [StockController::class, 'index']);
    Route::get('get/{id}', [StockController::class, 'show']);
    Route::put('update/{id}', [StockController::class, 'update']);
    Route::delete('delete/{id}', [StockController::class, 'destroy']);
    Route::post('store', [StockController::class, 'store']);
});

/// Book Service
Route::group([
    // 'middleware' => 'api',    /// Only enable to protect routes against login
    'prefix' => 'books'
], function () {
    Route::get('all', [BookController::class, 'index']);
    Route::get('get/{id}', [BookController::class, 'show']);
    Route::put('update/{id}', [BookController::class, 'update']);
    Route::delete('delete/{id}', [BookController::class, 'destroy']);
    Route::post('store', [BookController::class, 'store']);
});


/// Kind Service
Route::group([
    // 'middleware' => 'api',    /// Only enable to protect routes against login
    'prefix' => 'kinds'
], function () {
    Route::get('all', [KindController::class, 'index']);
    Route::get('get/{id}', [KindController::class, 'show']);
    Route::put('update/{id}', [KindController::class, 'update']);
    Route::delete('delete/{id}', [KindController::class, 'destroy']);
    Route::post('store', [KindController::class, 'store']);
});




/// Order Service
Route::group([
    //'middleware' => 'api',    /// Auth required
    'prefix' => 'orders'
], function () {
    Route::get('my', [OrderController::class, 'userOrders']);
    Route::post('store', [OrderController::class, 'store']);
});
