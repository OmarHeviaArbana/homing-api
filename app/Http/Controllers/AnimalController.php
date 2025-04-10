<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
            'housingStage'
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
            'weight' => 'nullable|string',
            'height' => 'nullable|string',
            'species_id' => 'required|exists:species,id',
            'status_id' => 'required|exists:status,id',
            'agecategory_id' => 'required|exists:agecategories,id',
            'genre_id' => 'required|exists:genres,id',
            'housing_stage_id' => 'required|exists:housing_stages,id',
            'size_id' => 'required|exists:sizes,id',
            'energylevel_id' => 'required|exists:energy_levels,id',
            'identifier' => 'required|boolean',
            'vaccines' => 'required|boolean',
            'sterilization' => 'required|boolean',
            'care' => 'nullable|string',
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
            'housingStage'
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
            'weight' => 'nullable|string',
            'height' => 'nullable|string',
            'species_id' => 'sometimes|required|exists:species,id',
            'status_id' => 'sometimes|required|exists:status,id',
            'agecategory_id' => 'sometimes|required|exists:agecategories,id',
            'genre_id' => 'sometimes|required|exists:genres,id',
            'housing_stage_id' => 'sometimes|required|exists:housing_stages,id',
            'size_id' => 'sometimes|required|exists:sizes,id',
            'energylevel_id' => 'sometimes|required|exists:energy_levels,id',
            'identifier' => 'sometimes|required|boolean',
            'vaccines' => 'sometimes|required|boolean',
            'sterilization' => 'sometimes|required|boolean',
            'care' => 'nullable|string',
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

        $animal->delete();

        return response()->json(['message' => 'Animal eliminado correctamente'], Response::HTTP_OK);
    }
}
