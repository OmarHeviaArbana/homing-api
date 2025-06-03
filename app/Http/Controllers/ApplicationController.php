<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Shelter;
use App\Models\Breeder;
use App\Models\User;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user', 'animal', 'shelter', 'breeder', 'housingStage'])->get();
        return response()->json($applications, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reason' => 'required|string',
            'housing_stage_id' => 'required|exists:housing_stages,id',
            'animal_id' => 'required|exists:animals,id',
            'user_id' => 'required|exists:users,id',
            'shelter_id' => 'nullable|exists:shelters,id',
            'breeder_id' => 'nullable|exists:breeders,id',
        ]);

        // Validación extra: sólo uno de los dos puede estar presente
        if (!($validated['shelter_id'] || $validated['breeder_id'])) {
            return response()->json(['message' => 'Debe especificar un shelter_id o breeder_id'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $application = Application::create($validated);

        return response()->json([
            'message' => 'Solicitud enviada correctamente',
            'application' => $application
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $application = Application::with(['user', 'animal', 'shelter', 'breeder', 'housingStage'])->find($id);

        if (! $application) {
            return response()->json(['message' => 'Solicitud no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($application, Response::HTTP_OK);
    }


    public function destroy($id)
    {
        $application = Application::find($id);

        if (! $application) {
            return response()->json(['message' => 'Solicitud no encontrada'], Response::HTTP_NOT_FOUND);
        }

        $application->delete();

        return response()->json(['message' => 'Solicitud eliminada correctamente'], Response::HTTP_OK);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $application = Application::find($id);

        if (! $application) {
            return response()->json(['message' => 'Solicitud no encontrada'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'housing_stage_id' => 'sometimes|exists:housing_stages,id',
            'reason' => 'sometimes|string',
        ]);

        $application->update($validated);

        return response()->json([
            'message' => 'Solicitud actualizada correctamente',
            'application' => $application
        ], Response::HTTP_OK);
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

    public function getByUser($userId): JsonResponse
    {
        $user = User::find($userId);
        if (! $user) {
            return response()->json(['message' => 'user no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $applications = Application::where('user_id', $userId)->with(['animal', 'user' , 'breeder', 'shelter'])->get();
        return response()->json($applications, Response::HTTP_OK);
    }
}
