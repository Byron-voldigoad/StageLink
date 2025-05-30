<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index()
    {
        return response()->json(Matiere::all());
    }

    public function store(Request $request)
    {
        $matiere = Matiere::create($request->all());
        return response()->json($matiere, 201);
    }

    public function show($id)
    {
        return response()->json(Matiere::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $matiere = Matiere::findOrFail($id);
        $matiere->update($request->all());
        return response()->json($matiere);
    }

    public function destroy($id)
    {
        Matiere::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
