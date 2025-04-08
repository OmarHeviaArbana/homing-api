<?php

namespace App\Http\Controllers;

use App\Models\Breeder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class BreederController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $breeders = Breeder::with('user')->get();
        return response()->json($breeders, Response::HTTP_OK);
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
            'certification' => 'required|string',
            'phone' => 'required|string',
            'email_breeder' => 'required|string'
        ]);

        $breeder = Breeder::create($validated);

        return response()->json([
            'message' => 'Criador creado exitosamente',
            'breeder' => $breeder
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $breeder = Breeder::with('user')->find($id);

        if (! $breeder) {
            return response()->json(['message' => 'Criador no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($breeder, Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id): JsonResponse
    {
        $breeder = Breeder::find($id);

        if (! $breeder) {
            return response()->json(['message' => 'Criador no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'name' => 'sometimes|required|string',
            'logo_url' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'location' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'certification' => 'sometimes|required|string',
            'phone' => 'sometimes|required|string',
            'email_breeder' => 'sometimes|required|string',
        ]);

        $breeder->update($validated);

        return response()->json([
            'message' => 'Criador actualizado correctamente',
            'breeder' => $breeder
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $breeder = Breeder::find($id);

        if (! $breeder) {
            return response()->json(['message' => 'Criador no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $breeder->delete();

        return response()->json(['message' => 'Criador eliminado correctamente'], Response::HTTP_OK);
    }
}
