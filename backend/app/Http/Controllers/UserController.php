<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    

public function profile(Request $request)
{
    $user = $request->user(); // Authenticated user

    return response()->json([
        'username' => $user->username,
        'email' => $user->email,
        'role' => match ($user->role) {
            0 => 'Admin',
            1 => 'Manager',
            default => 'User',
        }
    ]);
}

    // Get all users
    public function users()
    {
        return response()->json(User::all());
    }

    // Store new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:3',
            'role' => 'required|integer',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // Show a specific user
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    // Update a user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully']);
    }

    // Delete a user
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    // For /userdashboard route
    public function index()
    {
        return response()->json(['message' => 'User Dashboard Accessed']);
    }


    //Account suspension and activation
    public function toggleStatus($id)
{
    $user = User::findOrFail($id);
    $user->suspended = !$user->suspended;
    $user->save();

    return response()->json([
        'message' => $user->suspended ? 'User suspended.' : 'User activated.',
        'status' => $user->suspended
    ]);
}

           public function userprofile(){
                $user = Auth::user();

                return response()->json([
                    'name' => $user->name,
                    'email' => $user->email,
                ]);

                return response()->json($user);
            }


          public function updateprofile(Request $request)
            {
                $user = $request->user(); 

                $request->validate([
                    'name' => 'string|max:255',
                    'email' => 'string|email|max:255',
                ]);

                $user->update($request->only(['name', 'email']));

                return response()->json([
                    'message' => 'Profile updated successfully',
                    'user' => $user
                ]);
            }

            public function updatePassword(Request $request)
            {
                $user = Auth::user();

                $request->validate([
                    'current_password' => 'required',
                    'new_password' => 'required|string|min:3|confirmed',
                ]);

                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json(['message' => 'Current password is incorrect'], 400);
                }

                $user->password = Hash::make($request->new_password);
                $user->save();

                return response()->json(['message' => 'Password updated successfully']);
            }

}