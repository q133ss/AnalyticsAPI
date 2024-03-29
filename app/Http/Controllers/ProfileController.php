<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileController\UpdateRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function me(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth()->user();
    }

    public function update(UpdateRequest $request): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        $user = Auth()->user();
        $user->update($request->validated());
        return $user;
    }
}
