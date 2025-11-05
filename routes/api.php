<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManagement\AuthController;
use App\Http\Controllers\Api\TenantProfileController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\TenantApiController;

Route::group(['middleware' => 'api'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);
    Route::middleware('auth:sanctum')->get('/tenant-profile', [TenantProfileController::class, 'show']);

        Route::middleware('auth:sanctum')->get('languages', [\App\Http\Controllers\Api\LanguageController::class, 'index']);
    Route::middleware('auth:sanctum')->post('languages', [\App\Http\Controllers\Api\LanguageController::class, 'store']);
    Route::middleware('auth:sanctum')->get('languages/{id}', [\App\Http\Controllers\Api\LanguageController::class, 'show']);
    Route::middleware('auth:sanctum')->put('languages/{id}', [\App\Http\Controllers\Api\LanguageController::class, 'update']);
    Route::middleware('auth:sanctum')->delete('languages/{id}', [\App\Http\Controllers\Api\LanguageController::class, 'destroy']);
    Route::middleware('auth:sanctum')->apiResource('tenants', TenantApiController::class);
});