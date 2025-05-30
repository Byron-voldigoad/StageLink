<?php

namespace App\Http\Controllers;

use App\Models\SujetExamen;
use Illuminate\Http\Request;

class SujetExamenController extends Controller
{
    public function index()
    {
        return response()->json(SujetExamen::all());
    }

    public function store(Request $request)
    {
        $sujet = SujetExamen::create($request->all());
        return response()->json($sujet, 201);
    }

    public function show($id)
    {
        return response()->json(SujetExamen::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $sujet = SujetExamen::findOrFail($id);
        $sujet->update($request->all());
        return response()->json($sujet);
    }

    public function destroy($id)
    {
        SujetExamen::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
