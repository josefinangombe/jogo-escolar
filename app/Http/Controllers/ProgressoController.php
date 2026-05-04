<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progresso; 
class ProgressoController extends Controller
{
    public function store(Request $request)
{
    return Progresso::create([
        'estado' => $request->estado,
        'pontuacao' => $request->pontuacao,
        'crianca_id' => $request->crianca_id,
        'atividade_id' => $request->atividade_id
    ]);
}
}
