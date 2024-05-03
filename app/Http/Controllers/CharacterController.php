<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $character = Character::create($request->all());
        $character->series()->attach($request->input('serie_id'));
        return response()->json($character, 201);
    }

    // Get a character
    public function show($id)
    {
        return Character::with('series')->find($id);
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
