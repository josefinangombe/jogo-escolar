<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel; 
class NivelController extends Controller
{
    public function porTema($tema)
{
    return Nivel::where('tema_id', $tema)->get();
}
}
