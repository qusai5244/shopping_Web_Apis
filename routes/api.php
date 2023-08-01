<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;


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


Route::resource('users', UsersController::class); // User API

Route::get('users/orders/{id}', [UsersController::class, 'getUserOrders']); // Get user's shopping cart


Route::resource('products', ProductsController::class); // products API

Route::resource('orders', OrderController::class); // Order API

Route::get('shopping-cart/{cart_id}', [ShoppingCartController::class, 'getUser']); // Get user's shopping cart



