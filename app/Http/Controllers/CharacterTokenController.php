<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CharacterTokenController extends Controller
{
    public function register(Request $request)
    {
        // Validar los datos del request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'character_name' => 'required|string|max:255' // Nombre del personaje
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Puedes añadir campos adicionales si es necesario
        ]);

        // Generar el token para el personaje
        $token = $user->createToken($request->character_name)->plainTextToken;

        // Respuesta con el token de personaje
        return response()->json([
            'message' => 'Usuario registrado y token de personaje generado con éxito.',
            'user' => $user,
            'character_token' => $token,
        ], 201);
    }
}
