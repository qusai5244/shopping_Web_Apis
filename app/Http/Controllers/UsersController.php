<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users
        $users = User::all();
        // return users names only
        $users = User::all()->pluck('name');
        return $users;
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= bcrypt($request->password);

        // Save the user
        $user->save();

        // Return a response with a resource JSON
        return response()->json([
            'data' => $user,
            'message' => 'User created successfully!'
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
        // Get the user
        $user = User::find($id);
        $user = $user->only(['name', 'email']);
        // Return a response with a resource JSON
        return response()->json([
            'data' => $user,
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            // Add more validation rules as needed
        ]);

        // Create a new user
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= bcrypt($request->password);

        // Save the user
        $user->save();

        // Return a response with a resource JSON
        return response()->json([
            'data' => $user,
            'message' => 'User updated successfully!'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get the user
        $user = User::find($id);
        // Delete the user
        $user->delete();
        // Return a response with a resource JSON
        return response()->json([
            'message' => 'User deleted successfully!'
        ], 200);

        // give the api route ?_method=DELETE
    }
}
