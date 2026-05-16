<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema; 
class TemaController extends Controller
{
   // LISTAR TODOS OS TEMAS
    public function index()
    {
        return response()->json(
            Tema::with(['area', 'subtemas'])->get()
        );
    }

    // MOSTRAR UM TEMA ESPECÍFICO
    public function show($id)
    {
        return response()->json(
            Tema::with(['area', 'subtemas'])->findOrFail($id)
        );
    }

    public function porArea($areaId)
{
    return response()->json(
        Tema::where('area_id', $areaId)->get()
    );
}
}
