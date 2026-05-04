<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema; 
class TemaController extends Controller
{
    public function porArea($area)
{
    return Tema::where('area_id', $area)->get();
}
}
