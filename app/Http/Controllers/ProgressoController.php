<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progresso;

class ProgressoController extends Controller
{
    /**
     * 🔥 MARCAR NÍVEL COMO CONCLUÍDO
     */
    use App\Models\Nivel;

public function store(Request $request)
{
    $request->validate([
        'crianca_id' => 'required|integer',
        'nivel_id' => 'required|integer',
        'pontuacao' => 'nullable|numeric'
    ]);

    // 1. salvar progresso
    $progresso = Progresso::updateOrCreate(
        [
            'crianca_id' => $request->crianca_id,
            'nivel_id' => $request->nivel_id
        ],
        [
            'estado' => 'concluido',
            'pontuacao' => $request->pontuacao ?? 0,
            'concluido' => true
        ]
    );

    // 2. 🔓 DESBLOQUEIO (AQUI É O IMPORTANTE)
    $nivelAtual = Nivel::find($request->nivel_id);

    $proximoNivel = Nivel::where('subtema_id', $nivelAtual->subtema_id)
        ->where('id', '>', $nivelAtual->id)
        ->orderBy('id')
        ->first();

    return response()->json([
        'message' => 'Nível concluído com sucesso',
        'progresso' => $progresso,
        'proximo_nivel_desbloqueado' => $proximoNivel
    ]);
}

    /**
     * 📊 BUSCAR PROGRESSO DE UMA CRIANÇA
     * (usado no Vue para desbloquear níveis)
     */
    public function progressoCrianca($id)
    {
        $progresso = Progresso::where('crianca_id', $id)->get();

        return response()->json([
            'crianca_id' => $id,
            'progresso' => $progresso
        ]);
    }

    /**
     * 🎯 VERIFICAR SE UM NÍVEL FOI CONCLUÍDO
     */
    public function verificarNivel(Request $request)
    {
        $existe = Progresso::where('crianca_id', $request->crianca_id)
            ->where('nivel_id', $request->nivel_id)
            ->where('concluido', true)
            ->exists();

        return response()->json([
            'concluido' => $existe
        ]);
    }
}