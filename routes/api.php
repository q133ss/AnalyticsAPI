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

    Route::middleware('is.admin')->prefix('admin')->group(function (){
        Route::post('/client/{client_id}/material', [\App\Http\Controllers\Admin\ClientController::class, 'storeMaterial']);
        Route::post('/client/update/{material_id}/material', [\App\Http\Controllers\Admin\ClientController::class, 'updateMaterial']);
        Route::delete('/client/{material_id}/material', [\App\Http\Controllers\Admin\ClientController::class, 'deleteMaterial']);
        Route::apiResource('client', \App\Http\Controllers\Admin\ClientController::class);

        Route::get('/general/materials', [\App\Http\Controllers\Admin\GeneralMaterialsController::class, 'index']);
        Route::post('/general/materials', [\App\Http\Controllers\Admin\GeneralMaterialsController::class, 'store']);
        Route::post('/general/materials/{id}/update', [\App\Http\Controllers\Admin\ClientController::class, 'updateMaterial']);
        Route::delete('/general/materials/{id}', [\App\Http\Controllers\Admin\ClientController::class, 'deleteMaterial']);

        Route::get('/special/reports', [\App\Http\Controllers\Admin\SpecialMaterialsController::class, 'index']);
        Route::post('/special/reports', [\App\Http\Controllers\Admin\SpecialMaterialsController::class, 'store']);
        Route::post('/special/reports/{id}/update', [\App\Http\Controllers\Admin\ClientController::class, 'updateMaterial']);
        Route::delete('/special/reports/{id}', [\App\Http\Controllers\Admin\ClientController::class, 'deleteMaterial']);

        Route::apiResource('category', App\Http\Controllers\Admin\CategoryController::class);
    });

    Route::get('/me', [\App\Http\Controllers\ProfileController::class, 'me']);
    Route::post('/me', [\App\Http\Controllers\ProfileController::class, 'update']);

    Route::get('/get/{type}', [\App\Http\Controllers\MaterialController::class, 'get']);
    Route::get('/favorite', [\App\Http\Controllers\MaterialController::class, 'getByIds']);
});

// перед отправкой нужно проверить все с 0!!!
