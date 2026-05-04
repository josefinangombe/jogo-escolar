<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subtema;

class SubtemaController extends Controller
{
    // Listar todos os subtemas
    public function index()
    {
        return Subtema::with('tema')->get();
    }

    // Criar subtema
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'tema_id' => 'required|exists:temas,id'
        ]);

        return Subtema::create($request->all());
    }

    // Mostrar um subtema específico
    public function show($id)
    {
        return Subtema::with('tema')->findOrFail($id);
    }

    // Atualizar subtema
    public function update(Request $request, $id)
    {
        $subtema = Subtema::findOrFail($id);

        $subtema->update($request->all());

        return $subtema;
    }

    // Eliminar subtema
    public function destroy($id)
    {
        return Subtema::destroy($id);
    }

     public function porTema($temaId)
    {
        return Subtema::where('tema_id', $temaId)->get();
    }
}
