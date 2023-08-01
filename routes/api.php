<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShoppingCartController;


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

Route::get('users/shopping-cart/{cart_id}', [UsersController::class, 'getUserCart']); // Get user's shopping cart

Route::get('shopping-cart/{cart_id}', [ShoppingCartController::class, 'getUser']); // Get user's shopping cart



