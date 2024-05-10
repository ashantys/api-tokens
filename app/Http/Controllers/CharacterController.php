<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Character;

class CharacterController extends Controller
{
    // Get all the characters
    public function index()
    {
        return Character::with('series')->get();
    }

    // Create a character
    public function store(Request $request)
    {
    // Validar los datos de entrada
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'series_id' => 'required|exists:series,id', // Asegura que la serie exista
    ]);

    // Crear el personaje con los datos validados
    $character = new Character($validatedData);
    $character->token = Str::uuid(); // Genera un UUID como token
    $character->save();

    return response()->json(['message' => 'Personaje creado con éxito', 'character' => $character]);
    }

    // Get a character
    public function show($id)
    {
        return Character::with('series')->find($id);
    }

    public function findByToken($token)
{
    $character = Character::where('token', $token)->first();
    if (!$character) {
        return response()->json(['message' => 'Personaje no encontrado'], 404);
    }
    return response()->json(['character' => $character]);
}

    // Update character
    public function update(Request $request, $id)
    {
        $character = Character::findOrFail($id);
        $character->update($request->all());
        $character->series()->sync($request->input('serie_id'));
        return response()->json($character, 200);
    }

    // Delete character
    public function destroy($id)
    {
        $character = Character::findOrFail($id);
        $character->delete();
        return response()->json(null, 204);
    }

}
