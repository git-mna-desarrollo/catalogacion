<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatrimonioController extends Controller
{
    public function formulario()
    {
        return view('patrimonio.formulario');
    }
}
