<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserPermissionController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('permissions', PermissionController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('roles', RoleController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('user-permissions', UserPermissionController::class);
});

