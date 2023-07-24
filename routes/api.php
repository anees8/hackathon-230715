<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\TailorController;
use App\Http\Controllers\OrdersController;




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

// Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);




Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('users', UsersController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('skus', SkuController::class);
    Route::resource('product_types', ProductTypeController::class);
    Route::resource('tailors', TailorController::class);
    Route::resource('orders', OrdersController::class);
    Route::get('/tailor_wise_order/{id}', [TailorController::class, 'orders']);
    Route::get('/tailor_wise_accepted_order/{id}', [TailorController::class, 'accepted_orders']);
    
    Route::post('/order_assign', [TailorController::class, 'orderAssign']);    
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
