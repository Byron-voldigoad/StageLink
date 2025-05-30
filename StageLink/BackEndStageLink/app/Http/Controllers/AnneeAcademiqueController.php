<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use Illuminate\Http\Request;

class AnneeAcademiqueController extends Controller
{
    public function index()
    {
        return response()->json(AnneeAcademique::all());
    }

    public function store(Request $request)
    {
        $annee = AnneeAcademique::create($request->all());
        return response()->json($annee, 201);
    }

    public function show($id)
    {
        return response()->json(AnneeAcademique::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $annee = AnneeAcademique::findOrFail($id);
        $annee->update($request->all());
        return response()->json($annee);
    }

    public function destroy($id)
    {
        AnneeAcademique::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
