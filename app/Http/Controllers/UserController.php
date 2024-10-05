<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserController
{

    public function getAll()
    {
        $users = User::all();
        if ($users->count() > 0) {
            return response()->json($users);
        } else {
            return response()->json(["message" => "No users found."], 404);
        }
    }

    public function getById($id)
    {
        $user = User::find($id);
        if ($user) {
            $result = [
                "message" => "User retrieved successfully.",
                "user" => $user
            ];
            return response()->json($result);
        } else {
            return response()->json(["message" => "User not found."], 404);
        }
    }

    public function store()
    {
        $validatedData = request()->validate([
            'first_name' => 'required|string|min:3|max:40',
            'last_name' => 'required|string|min:3|max:40',
            'phone_number' => 'required|regex:/^\+7\d{10}$/u',
            'avatar' => 'nullable|image|mimes:png,jpg|max:2048',
        ]);

        $user = User::create($validatedData);
        $result = [
            "message" => "User created successfully.",
            "user" => $user
        ];
        return response()->json($result);
    }

    public function update($id)
    {
        $user = User::find($id);
        $validatedData = request()->validate([
            'first_name' => 'string|min:3|max:40',
            'last_name' => 'string|min:3|max:40',
            'phone_number' => 'regex:/^\+7\d{10}$/u',
            'avatar' => 'nullable|image|mimes:png,jpg|max:2048',
        ]);

        if ($user) {
            $user->update($validatedData);
            $result = [
                "message" => "User updated successfully.",
                "user" => $user
            ];
            return response()->json($result);
        } else {
            return response()->json(["message" => "User not found."], 404);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $result = [
                "message" => "User deleted successfully.",
                "user" => $user
            ];
            return response()->json($result);
        } else
        {
            return response()->json(["message" => "User not found."], 404);
        }
    }

}
