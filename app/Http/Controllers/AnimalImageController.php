<?php

namespace App\Http\Controllers;

use App\Models\AnimalImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnimalImageController extends Controller
{
    /**
    * Display a listing of the resource.
     */
    public function index($animal_id)
    {
        $images = AnimalImage::where('animal_id', $animal_id)->get();
        return response()->json($images, Response::HTTP_OK);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'image_url' => 'required|string',
            'principal' => 'boolean'
        ]);

        // Si es principal, se desmarcan el resto de imagenes
        if (isset($validated['principal']) && $validated['principal']) {
            AnimalImage::where('animal_id', $validated['animal_id'])
                ->update(['principal' => false]);
        }

        $image = AnimalImage::create($validated);

        return response()->json([
            'message' => 'Imagen guardada correctamente',
            'image' => $image
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $image = AnimalImage::find($id);

        if (! $image) {
            return response()->json(['message' => 'Imagen no encontrada'], Response::HTTP_NOT_FOUND);
        }

        $image->delete();

        return response()->json(['message' => 'Imagen eliminada correctamente'], Response::HTTP_OK);
    }

    public function upload(Request $request)
{
    $request->validate([
        'image' => 'required|image|max:5000'
    ]);

    $path = $request->file('image')->store('public/animal_images');
    $url = str_replace('public/', 'storage/', $path);

    return response()->json([
        'image_url' => $url
    ], Response::HTTP_OK);
}


}
