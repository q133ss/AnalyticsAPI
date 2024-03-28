<?php

namespace App\Services\AuthController;

use App\Models\User;

class LoginService
{
    public function login(array $data): \Illuminate\Http\JsonResponse
    {
        $user = User::where('login', $data['login'])->first();
        $token = $user->createToken('api')->plainTextToken;
        return Response()->json(['user' => $user, 'token' => $token]);
    }
}
