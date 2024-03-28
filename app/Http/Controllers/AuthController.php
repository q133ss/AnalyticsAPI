<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthController\LoginRequest;
use App\Http\Requests\AuthController\ResetPasswordCodeRequest;
use App\Http\Requests\AuthController\ResetPasswordRequest;
use App\Models\User;
use App\Services\AuthController\LoginService;
use App\Services\AuthController\SendCodeService;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new LoginService())->login($request->validated());
    }

    public function isAdmin(): \Illuminate\Http\JsonResponse
    {
        return Response()->json(['is_admin' => Auth()->user()->isAdmin()]);
    }

    public function resetPasswordCode(ResetPasswordCodeRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new SendCodeService())->sendCode($request->validated());
    }

    public function resetPassword(ResetPasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        return Response()->json(['message' => 'Пароль успешно обновлен']);
    }
}
