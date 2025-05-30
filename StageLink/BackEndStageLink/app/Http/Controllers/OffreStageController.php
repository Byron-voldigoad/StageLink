<?php

namespace App\Http\Controllers;

use App\Models\OffreStage;
use Illuminate\Http\Request;

class OffreStageController extends Controller
{
    public function index()
    {
        return response()->json(OffreStage::all());
    }

    public function store(Request $request)
    {
        $offre = OffreStage::create($request->all());
        return response()->json($offre, 201);
    }

    public function show($id)
    {
        return response()->json(OffreStage::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $offre = OffreStage::findOrFail($id);
        $offre->update($request->all());
        return response()->json($offre);
    }

    public function destroy($id)
    {
        OffreStage::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
