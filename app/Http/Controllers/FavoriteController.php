<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $favorites = Favorite::with(['user', 'animal'])->get();
        return response()->json($favorites, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'animal_id' => 'required|exists:animals,id',
        ]);

        $favorite = Favorite::create($validated);

        return response()->json([
            'message' => 'Animal añadido a favoritos',
            'favorite' => $favorite
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $favorite = Favorite::find($id);

        if (! $favorite) {
            return response()->json(['message' => 'Favorito no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $favorite->delete();

        return response()->json(['message' => 'Favorito eliminado correctamente'], Response::HTTP_OK);
    }

    public function getFavoriteByUser($userId)
    {
        $favorites = Favorite::where('user_id', $userId)->with('animal')->get();

        return response()->json($favorites, Response::HTTP_OK);
    }
}
