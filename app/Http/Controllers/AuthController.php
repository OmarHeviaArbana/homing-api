<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        if(! Auth::attempt($request->validated())) {
            return response()->json([

                'errors' => 'Credenciales erroneas'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();
        $userToken = $user->createToken('AppToken')-> plainTextToken;
        return response()->json([
            'message' => 'Se ha iniciado sesión correctamente',
            'token' => $userToken,
            'user' => $user
        ], Response::HTTP_OK);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());
        $userToken = $user->createToken('AppToken')->plainTextToken;


        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'token' => $userToken,
            'user' => $user
        ], Response::HTTP_CREATED);
    }

    public function logout(Request $request): JsonResponse
    {
     $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Se ha cerrado sesión correctamente',
        ], Response::HTTP_OK);
    }
}
