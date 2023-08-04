<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Support\Facades\Http;


class ShoppingCartController extends Controller
{
    public function index()
    {
        $shoppingCart = ShoppingCart::all();
        return response()->json($shoppingCart);
    }



    public function store($user_id, $product_id)
    {
    $product = Product::find($product_id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $shoppingCart = ShoppingCart::where('user_id', $user_id)
        ->where('product_id', $product_id)
        ->first();

    if ($shoppingCart) {
        $shoppingCart->quantity += 1;
        $shoppingCart->save();
    } else {
        $shoppingCart = ShoppingCart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => 1,
            'unit_price' => $product->product_price, // Set unit_price from the Product model
        ]);
    }

    return response()->json($shoppingCart, 200);
    }


    public function show_my_cart($user_id)
    {
        $shoppingCart = ShoppingCart::where('user_id', $user_id)->get();
        // get total price
        $total_price = 0;

        foreach ($shoppingCart as $item) {
            $item_name = Product::find($item->product_id)->product_name;
            $total_price += $item->quantity * $item->unit_price;
            $item->product_name = $item_name;
        }

        $shoppingCart['total_price'] = $total_price;
        return response()->json($shoppingCart);
    }

    public function remove_product($user_id, $product_id)
    {
        $shoppingCart = ShoppingCart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if (!$shoppingCart) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $shoppingCart->delete();

        return response()->json(['message' => 'Product removed from cart'], 200);
    }

    public function thawaniCallBack($status)
    {
        return "Payment " . $status;
    }

    public function checkout($user_id){

        $shoppingCart = ShoppingCart::where('user_id', $user_id)->get();

        $products = [];

        foreach ($shoppingCart as $product) {

            $products[] = [
                'name' => Product::find($product->product_id)->product_name,
                'quantity' => $product->quantity,
                'unit_amount' => intval($product->unit_price) * 1000,
            ];

        }

        $metadata = [
            'customer_name' => "Qusai Alnaabi",
            'email' => 'a@a.com',
        ];

        $data=[
            'client_reference_id'=> $user_id,
            'mode' => 'payment',
            'products' => $products,
            'success_url' => 'http://localhost:8000/api/payment/success',
            'cancel_url' => 'http://localhost:8000//api/payment/failed',
            'metadata' => $metadata,
        ];

        $response = Http::withHeaders([
            'thawani-api-key'=>'rRQ26GcsZzoEhbrP2HZvLYDbn9C9et'
        ])->post("https://uatcheckout.thawani.om/api/v1/checkout/session", $data);

        if($response->successful()){
            return json_decode($response);
        //     $tempResponse = json_decode($response);
        //     $session_idd = $tempResponse->data->session_id;
        //     $public_key = "HGvTMLDssJghr9tlN9gr4DVYt0qyBy";

        //     return redirect("https://uatcheckout.thawani.om/pay/$session_idd?key=$public_key");
        }

        return 'failed';
    }

}

