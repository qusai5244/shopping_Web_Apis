<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;

class ShoppingCartController extends Controller
{
    public function getUser($cartId)
    {
        // Find the shopping cart by cart ID
        $shoppingCart = ShoppingCart::findOrFail($cartId);

        // Retrieve the user associated with the shopping cart
        $user = $shoppingCart->user;
        $user = $user->only(['name', 'email']);

        // Return a response with the user data
        return response()->json([
            'data' => $user,
            'message' => 'User linked to the cart.'
        ]);
    }
}
