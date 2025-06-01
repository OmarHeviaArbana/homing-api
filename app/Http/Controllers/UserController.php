<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['shelter', 'breeder'])->get();
        return response()->json($users, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'user' => $user
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json(['message' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        if ($user->role_id == 3) {
            $user->load('shelter');
        } elseif ($user->role_id == 4) {
            $user->load('breeder');
        }

        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json(['message' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'username' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'sometimes|required|exists:roles,id'
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'user' => $user
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json(['message' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente'], Response::HTTP_OK);
    }


        public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5000'
        ]);

        $path = $request->file('image')->store('user', 'public');
        $url = str_replace('public/', 'storage/', $path);

        return response()->json([
            'image_url' => $url
        ], Response::HTTP_OK);
    }
}
