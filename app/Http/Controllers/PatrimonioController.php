<?php

namespace App\Http\Controllers;

use App\Localidad;
use App\Provincia;
use App\Departamento;
use App\Tecnicamaterial;
use Illuminate\Http\Request;

class PatrimonioController extends Controller
{
    public function formulario()
    {
        $departamentos = Departamento::all();
        $localidades = Localidad::all();
        $provincias = Provincia::all();
        $tecnicas = Tecnicamaterial::all();
        dd($tecnicas);
        return view('patrimonio.formulario');
    }
}
