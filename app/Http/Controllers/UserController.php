<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show_user(User $user)
    {

        return response()->json([
            'message' => 'success',
            'user' => $user
        ]);
    }

    // Edit user profile
    public function edit_user(User $user)
    {

        return response()->json([
            'message' => 'success',
            'user' => $user,
        ]);
    }

    // Update user profile
    public function update_user(User $user, Request $request)
    {

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:6|confirmed',
        ]);

        // Update user
        $user->update([
            'name' => $request->name,
            'age' => $request->age,
        ]);

        return response()->json(['message' => 'User profile updated successfully']);
    }

    // Destroy (delete) user profile
    public function destroy_user(User $user)
    {
        // Delete user
        $user->delete();

        return response()->json(['message' => 'User profile deleted successfully']);
    }
}
