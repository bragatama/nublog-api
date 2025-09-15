<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $loginField = $request->getLoginField();

        if (!Auth::attempt([$loginField => $request->login, 'password' => $request->password])) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where($loginField, $request->login)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ], 'User logged in successfully');
    }

    public function register(StoreUserRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "username" => $request->username,
            "password" => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ], "User created successfully", 201);
    }
    public function logout()
    {
        return $this->success([], "Logged out successfully");
    }
}
