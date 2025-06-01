<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Shelter;
use App\Models\Breeder;
use App\Models\Application;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animals = Animal::with([
            'species',
            'status',
            'genre',
            'ageCategory',
            'size',
            'energyLevel',
            'housingStage',
            'shelter',
            'breeder',
            'images'
        ])->get();

        return response()->json($animals, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'weight' => 'required|string',
            'height' => 'required|string',
            'species_id' => 'required|exists:species,id',
            'status_id' => 'required|exists:status,id',
            'agecategory_id' => 'required|exists:agecategories,id',
            'genre_id' => 'required|exists:genres,id',
            'housing_stage_id' => 'nullable||exists:housing_stages,id',
            'size_id' => 'required|exists:sizes,id',
            'energylevel_id' => 'required|exists:energy_levels,id',
            'identifier' => 'required|boolean',
            'vaccines' => 'required|boolean',
            'sterilization' => 'required|boolean',
            'care' => 'required|string',
            'shelter_id' => 'nullable|exists:shelters,id',
            'breeder_id' => 'nullable|exists:breeders,id',
        ]);

        $animal = Animal::create($validated);

        return response()->json([
            'message' => 'Animal creado correctamente',
            'animal' => $animal
        ], Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $animal = Animal::with([
            'species',
            'status',
            'genre',
            'ageCategory',
            'size',
            'energyLevel',
            'housingStage',
            'shelter',
            'breeder',
            'images'
        ])->find($id);

        if (! $animal) {
            return response()->json(['message' => 'Animal no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($animal, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $animal = Animal::find($id);

        if (! $animal) {
            return response()->json(['message' => 'Animal no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'location' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'weight' => 'sometimes|string',
            'height' => 'sometimes|string',
            'species_id' => 'sometimes|required|exists:species,id',
            'status_id' => 'sometimes|required|exists:status,id',
            'agecategory_id' => 'sometimes|required|exists:agecategories,id',
            'genre_id' => 'sometimes|required|exists:genres,id',
            'housing_stage_id' => 'nullable|required|exists:housing_stages,id',
            'size_id' => 'sometimes|required|exists:sizes,id',
            'energylevel_id' => 'sometimes|required|exists:energy_levels,id',
            'identifier' => 'sometimes|required|boolean',
            'vaccines' => 'sometimes|required|boolean',
            'sterilization' => 'sometimes|required|boolean',
            'care' => 'sometimes|required| string',
        ]);

        $animal->update($validated);

        return response()->json([
            'message' => 'Animal actualizado correctamente',
            'animal' => $animal
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $animal = Animal::find($id);

    if (! $animal) {
        return response()->json(['message' => 'Animal no encontrado'], Response::HTTP_NOT_FOUND);
    }

    // Borrar imágenes asociadas
    $animal->images()->delete();

    // Borrar el animal
    $animal->delete();

    return response()->json(['message' => 'Animal eliminado correctamente'], Response::HTTP_OK);
}

    public function getByShelter($shelterId): JsonResponse
    {
        $shelter = Shelter::find($shelterId);
        if (! $shelter) {
            return response()->json(['message' => 'Shelter no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $applications = Application::where('shelter_id', $shelterId)->with(['animal', 'user'])->get();
        return response()->json($applications, Response::HTTP_OK);
    }

    public function getByBreeder($breederId): JsonResponse
    {
        $breeder = Breeder::find($breederId);
        if (! $breeder) {
            return response()->json(['message' => 'Breeder no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $applications = Application::where('breeder_id', $breederId)->with(['animal', 'user'])->get();
        return response()->json($applications, Response::HTTP_OK);
    }
}
