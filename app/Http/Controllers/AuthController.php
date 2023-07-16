<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{


public function register(Request $request){
    // Validate request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
    ]);

    // Create a new user
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']),
    ]);


    return response()->json(['user' => $user], 201);
}

public function login(Request $request)
{
    // Validate request data
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Authenticate the user
    if (Auth::attempt($credentials)) {
        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response()->json(['access_token' => $accessToken], 200);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

public function logout(Request $request)
{
    $request->user()->token()->revoke();

    return response()->json(['message' => 'Successfully logged out']);
}

}
