<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',          // Nombre del usuario
            'username' => 'required|string|max:255|unique:users,username', // Nombre de usuario único
            'email' => 'required|email|unique:users,email', // Correo único y formato correcto
            'password' => 'required|string|min:8', // Contraseña con confirmación y longitud mínima
            'role_id' => 'required|exists:roles,id',  // Verifica que el role_id esté en la tabla roles
        ];
    }
}
