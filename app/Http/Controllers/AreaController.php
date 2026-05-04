<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area; 

class AreaController extends Controller
{
    public function index()
{
    return Area::all();
    //return Area::with('temas')->get();
}
}
