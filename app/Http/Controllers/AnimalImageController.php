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
            'photos' => 'required|array',
            'photos.*.image_url' => 'required|string',
            'photos.*.principal' => 'boolean'
        ]);

        $animal_id = $validated['animal_id'];
        $photos = $validated['photos'];

        $hasPrincipal = collect($photos)->contains(fn($photo) => isset($photo['principal']) && $photo['principal']);
        if ($hasPrincipal) {
            AnimalImage::where('animal_id', $animal_id)->update(['principal' => false]);
        }

        $createdImages = [];
        foreach ($photos as $photo) {
            $data = [
                'animal_id' => $animal_id,
                'image_url' => $photo['image_url'],
                'principal' => $photo['principal'] ?? false,
            ];
            $createdImages[] = AnimalImage::create($data);
        }

        return response()->json([
            'message' => 'Imágenes guardadas correctamente',
            'images' => $createdImages
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


    public function addImageWithUpload(Request $request)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'image' => 'required|image|max:5000',
            'principal' => 'boolean'
        ]);

    $path = $request->file('image')->store('animal_images', 'public');
        $url = str_replace('public/', 'storage/', $path);

        if ($request->boolean('principal')) {
            AnimalImage::where('animal_id', $validated['animal_id'])->update(['principal' => false]);
        }

        $animalImage = AnimalImage::create([
            'animal_id' => $validated['animal_id'],
            'image_url' => $url,
            'principal' => $request->boolean('principal'),
        ]);

        return response()->json([
            'message' => 'Imagen subida y guardada correctamente',
            'image' => $animalImage
        ], Response::HTTP_CREATED);
    }


}
