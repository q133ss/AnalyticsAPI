<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/reset/password/code', [\App\Http\Controllers\AuthController::class, 'resetPasswordCode']);
Route::post('/reset/password', [\App\Http\Controllers\AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('is-admin', [\App\Http\Controllers\AuthController::class, 'isAdmin']);
});
// Clients | logo(file), company, name, login, password
