<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Fetch all users
    public function users()
    {
        return response()->json(User::all());
    }

    // Fetch profile of authenticated user
    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ]);
    }

   
        // Fetch all users
        public function index()
        {
            return User::all();
        }
    
        // Store or update a user
        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . ($request->id ?? ''),
                'role' => 'required|integer'
            ]);
    
            $user = User::updateOrCreate(
                ['id' => $request->id],
                $validated
            );
    
            return response()->json(['success' => true, 'user' => $user]);
        }
    
        // Delete a user
        public function destroy($id)
        {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return response()->json(['success' => true]);
            }
    
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
    }

