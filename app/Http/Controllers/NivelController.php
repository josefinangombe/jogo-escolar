<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;
use App\Models\Subtema;

class NivelController extends Controller
{
    public function porSubtema($subtema)
{
    return Nivel::where('subtema_id', $subtema)->get();
}
}
