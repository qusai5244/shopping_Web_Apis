<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $shoppingCart = ShoppingCart::all();
        return response()->json($shoppingCart);
    }
}
