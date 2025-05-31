<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:3',
            'role'     => 'required|integer|in:0,1,2', // 0=Admin, 1=Manager, 2=User
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user
        ], 201);
    }

     // Login ni sija
    public function login(Request $request)
{
    try {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $user = Auth::user();

            // Check if suspended
            if ($user->suspended) {
                Auth::logout(); // Just in case
                return response()->json([
                    'message' => 'Your account has been suspended.',
                ], 403);
            }

            $token = $user->createToken('mytoken')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'role' => $user->role,
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Something went wrong during login.',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
