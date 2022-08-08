<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $req)
    {
        $fields = $req->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($fields)) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->createToken('token')->plainTextToken,
            ];
            return response()->json(['data' => $data, 'message' => 'login success']);
        }

        return response()->json(['message' => 'Unauthorised'], 401);
    }

    public function register(Request $req)
    {
        $fields = $req->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $fields["password"] = Hash::make($fields["password"]);
        $user = User::create($fields);
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->createToken('token')->plainTextToken,
        ];

        return response()->json(['data' => $data, 'message' => 'register success']);
    }
}
