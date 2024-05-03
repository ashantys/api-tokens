<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SerieController extends Controller
{
        // Get series
        public function index()
        {
            return Serie::all();
        }

        //Get a new series
        public function store(Request $request)
        {
            $serie = Serie::create($request->all());
            return response()->json($serie, 201);
        }

        // Get specific serie
        public function show($id)
        {
            return Serie::find($id);
        }

        // Update a serie
        public function update(Request $request, $id)
        {
            $serie = Serie::findOrFail($id);
            $serie->update($request->all());
            return response()->json($serie, 200);
        }

        // Delete a serie
        public function destroy($id)
        {
            $serie = Serie::findOrFail($id);
            $serie->delete();
            return response()->json(null, 204);
        }
}
