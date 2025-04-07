<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar tus rutas de la API. Estas rutas están cargadas
| automáticamente por el archivo RouteServiceProvider dentro del grupo
| de middleware "api". ¡Disfruta creando tu API!
|
*/



Route::group(['prefix' => 'Auth'], function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::delete('logout', [AuthController::class, 'logout'])->middleware(('auth:sanctum'));
});

Route::group(['prefix' => 'Users'], function() {
    Route::get('getAll', [UserController::class, 'index'])->middleware(('auth:sanctum'));
    Route::post('create', [UserController::class, 'store'])->middleware(('auth:sanctum'));
    Route::get('getUser/{id}', [UserController::class, 'show'])->middleware('auth:sanctum');
    Route::put('update/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('delete/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');
});

