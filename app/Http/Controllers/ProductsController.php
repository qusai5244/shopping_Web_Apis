<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        // how to return products as json
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0'
        ]);

        // Create a new product
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->save();

        // Return a response with a resource JSON
        return response()->json([
            'data' => $product,
            'message' => 'Product created successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get the product
        $product = Product::find($id);
        // Return a response with a resource JSON
        return response()->json([
            'data' => $product,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0'
        ]);

        // Get the product
        $product = Product::find($id);
        $product->product_name = $request->name;
        $product->product_price = $request->price;
        $product->save();

        // Return a response with a resource JSON
        return response()->json([
            'data' => $product,
            'message' => 'Product updated successfully!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get the product
        $product = Product::find($id);
        $product->delete();

        // Return a response with a resource JSON
        return response()->json([
            'data' => $product,
            'message' => 'Product deleted successfully!'
        ], 200);
    }

    public function add_product_to_cart($user_id, $product_id)
    {
        $product = Product::find($product_id);
        $shoppingCart = user::find($user_id)->shoppingCart;
        $shoppingCart->products()->attach($product_id);
        return response()->json([
            'data' => $product,
            'message' => 'Product added to cart successfully!'
        ], 200);
    }
}
