<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Usercontroller extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password'], ['rounds' => 12]);
            $user = User::create($data);

            return response()->json(['message' => 'User created successfully', 'data' => $user], 201);

        } catch (\Exception $e) {
            report($e);
            return response()->json(['message' => 'User cannot be created ' . $e->getMessage()], 400);
        }
    }

    public function login(UserLoginRequest $request)
    {
        $request->validated();

        if (auth()->attempt($request->only('email', 'password'))) {
            $user = auth()->user();
            $token = $user->createToken('my-app-token')->accessToken;

            return response()->json([
                'message' => 'User connected successfully',
                'user' => $user,
                'token' => $token['token'],
            ], 200);

        } else {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }
    }
}
