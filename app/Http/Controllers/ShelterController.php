<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class ShelterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $shelters = Shelter::with('user')->get();
        return response()->json($shelters, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'logo_url' => 'required|string',
            'address' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'cif' => 'required|string',
            'phone' => 'required|string',
            'email_shelter' => 'required|string'
        ]);

        $shelter = Shelter::create($validated);

        return response()->json([
            'message' => 'Refugio creado exitosamente',
            'shelter' => $shelter
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $shelter = Shelter::with('user')->find($id);

        if (! $shelter) {
            return response()->json(['message' => 'Refugio no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($shelter, Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id): JsonResponse
    {
        $shelter = Shelter::find($id);

        if (! $shelter) {
            return response()->json(['message' => 'Refugio no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'name' => 'sometimes|required|string',
            'logo_url' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'location' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'cif' => 'sometimes|required|string',
            'phone' => 'sometimes|required|string',
            'email_shelter' => 'sometimes|required|string',
        ]);

        $shelter->update($validated);

        return response()->json([
            'message' => 'Refugio actualizado correctamente',
            'shelter' => $shelter
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $shelter = Shelter::find($id);

        if (! $shelter) {
            return response()->json(['message' => 'Refugio no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $shelter->delete();

        return response()->json(['message' => 'Refugio eliminado correctamente'], Response::HTTP_OK);
    }
}
