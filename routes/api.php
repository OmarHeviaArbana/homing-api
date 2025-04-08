<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BreederController;
use App\Http\Controllers\ShelterController;
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



Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::delete('logout', [AuthController::class, 'logout'])->middleware(('auth:sanctum'));
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function() {
    Route::get('getAll', [UserController::class, 'index']);
    Route::post('create', [UserController::class, 'store']);
    Route::get('getUser/{id}', [UserController::class, 'show']);
    Route::put('update/{id}', [UserController::class, 'update']);
    Route::delete('delete/{id}', [UserController::class, 'destroy']);
});


Route::group(['prefix' => 'breeders', 'middleware' => 'auth:sanctum'], function () {
    Route::get('getAll', [BreederController::class, 'index']);
    Route::post('create', [BreederController::class, 'store']);
    Route::get('getBreeder/{id}', [BreederController::class, 'show']);
    Route::put('update/{id}', [BreederController::class, 'update']);
    Route::delete('delte/{id}', [BreederController::class, 'destroy']);
});

Route::group(['prefix' => 'shelters', 'middleware' => 'auth:sanctum'], function () {
    Route::get('getAll', [ShelterController::class, 'index']);
    Route::post('create', [ShelterController::class, 'store']);
    Route::get('getShelter/{id}', [ShelterController::class, 'show']);
    Route::put('update/{id}', [ShelterController::class, 'update']);
    Route::delete('delte/{id}', [ShelterController::class, 'destroy']);
});

