<?php

namespace App\Http\Controllers;

use App\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function listado(){

        $especialidades = Especialidad::get();

        return view('especialidad.formulario')->with(compact('especialidades'));        
        // $especialidades2 = Especialidad::all();
        // dd($especialidades);
    }
}
