<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserPermissionController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AttributeController;  
use App\Http\Controllers\Api\AttributeValueController;
use App\Http\Controllers\Api\ProductController; 
use App\Http\Controllers\Api\VariantController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('roles', RoleController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('user-permissions', UserPermissionController::class);
});
    Route::apiResource('permissions', PermissionController::class);
});

Route::apiResource('brands', BrandController::class);

Route::apiResource('categories', CategoryController::class);
Route::apiResource('attributes', AttributeController::class);

Route::apiResource('attribute-values', AttributeValueController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('variants', VariantController::class);


