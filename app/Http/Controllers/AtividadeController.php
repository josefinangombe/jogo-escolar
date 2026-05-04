<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atividade; 
class AtividadeController extends Controller
{
    public function porNivel($nivel)
{
    return Atividade::where('nivel_id', $nivel)->get();
}
}
