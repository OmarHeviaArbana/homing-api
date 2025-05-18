<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BreederController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AnimalImageController;
use App\Http\Controllers\ApplicationController;
use App\Models\Species;
use App\Models\Status;
use App\Models\AgeCategory;
use App\Models\Genre;
use App\Models\HousingStage;
use App\Models\Size;
use App\Models\EnergyLevel;


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

Route::post('/auth/api-login', [AuthController::class, 'apiLogin']);


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
    Route::delete('delete/{id}', [BreederController::class, 'destroy']);
});

Route::group(['prefix' => 'shelters', 'middleware' => 'auth:sanctum'], function () {
    Route::get('getAll', [ShelterController::class, 'index']);
    Route::post('create', [ShelterController::class, 'store']);
    Route::get('getShelter/{id}', [ShelterController::class, 'show']);
    Route::put('update/{id}', [ShelterController::class, 'update']);
    Route::delete('delete/{id}', [ShelterController::class, 'destroy']);
});

Route::group(['prefix' => 'animals', 'middleware' => 'auth:sanctum'], function () {
    Route::get('getAll', [AnimalController::class, 'index']);
    Route::post('create', [AnimalController::class, 'store']);
    Route::get('getAnimal/{id}', [AnimalController::class, 'show']);
    Route::put('update/{id}', [AnimalController::class, 'update']);
    Route::delete('delete/{id}', [AnimalController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('species', fn () => Species::all());
    Route::get('status', fn () => Status::all());
    Route::get('agecategories', fn () => AgeCategory::all());
    Route::get('genres', fn () => Genre::all());
    Route::get('housing-stages', fn () => HousingStage::all());
    Route::get('sizes', fn () => Size::all());
    Route::get('energy-levels', fn () => EnergyLevel::all());
});

Route::group(['prefix' => 'favorites', 'middleware' => 'auth:sanctum'], function () {
    Route::get('getAll', [FavoriteController::class, 'index']);
    Route::post('add', [FavoriteController::class, 'store']);
    Route::delete('delete/{id}', [FavoriteController::class, 'destroy']);
    Route::get('user/{userId}', [FavoriteController::class, 'getFavoriteByUser']);
});

Route::prefix('animal-images')->middleware('auth:sanctum')->group(function () {
    Route::get('getImages/{animal_id}', [AnimalImageController::class, 'index']);
    Route::post('add', [AnimalImageController::class, 'store']);
    Route::delete('delete/{id}', [AnimalImageController::class, 'destroy']);
});


Route::group(['prefix' => 'applications', 'middleware' => 'auth:sanctum'], function () {
    Route::get('getAll', [ApplicationController::class, 'index']);
    Route::post('create', [ApplicationController::class, 'store']);
    Route::get('getApplication/{id}', [ApplicationController::class, 'show']);
    Route::delete('/{id}', [ApplicationController::class, 'destroy']);
    Route::get('shelter/{id}', [ApplicationController::class, 'getByShelter']);
    Route::get('breeder/{id}', [ApplicationController::class, 'getByBreeder']);
    Route::put('update/{id}', [ApplicationController::class, 'update']);
});
