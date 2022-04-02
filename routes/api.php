<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecommendController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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
