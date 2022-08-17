<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     operationId="login",
     *     tags={"auth"},
     *     summary="login",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  required={"email", "password"},
     *                  @OA\Property(property="email",example="test@mail.com"),
     *                  @OA\Property(property="password",example="password"),
     *              ),
     *          )
     *     ),
     *     @OA\Response(response="200", description="ok", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthorized", @OA\JsonContent()),
     * )
     *
     * Login.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->createToken('token')->plainTextToken,
            ];
            return response()->json(['data' => $data, 'message' => 'login success']);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     operationId="register",
     *     tags={"auth"},
     *     summary="register",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  required={"name", "email", "password", "password_confirmation"},
     *                  @OA\Property(property="name",example="test"),
     *                  @OA\Property(property="email",example="test@mail.com"),
     *                  @OA\Property(property="password",example="password"),
     *                  @OA\Property(property="password_confirmation",example="password"),
     *              ),
     *          )
     *     ),
     *     @OA\Response(response="200", description="ok", @OA\JsonContent()),
     *     @OA\Response(response="422", description="Unprocessable Content", @OA\JsonContent()),
     * )
     *
     * Login.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->createToken('token')->plainTextToken,
        ];

        return response()->json(['data' => $data, 'message' => 'register success']);
    }
}
