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

Route::resource('products', ProductsController::class); // Product API

Route::get('shopping-carts', [ShoppingCartController::class,'index']); // Shopping Cart API

Route::post('add-to-cart/{user_id}/{product_id}', [ShoppingCartController::class,'store']); // Shopping Cart API

Route::get('my-cart/{user_id}', [ShoppingCartController::class,'show_my_cart']); // Shopping Cart API

Route::post('my-cart/remove-product/{user_id}/{product_id}', [ShoppingCartController::class,'remove_product']); // Shopping Cart API

Route::post('my-cart/checkout/{user_id}', [ShoppingCartController::class,'checkout']); // Shopping Cart API

Route::post('payment/{status}', [ShoppingCartController::class,'thawaniCallBack']); // Shopping Cart API



