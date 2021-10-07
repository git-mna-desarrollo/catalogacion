<?php

namespace App\Http\Controllers;

use App\Localidad;
use App\Provincia;
use App\Ubicacion;
use App\Departamento;
use App\Tecnicamaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatrimonioController extends Controller
{
    public function formulario()
    {
        $departamentos = Departamento::all();
        $localidades = Localidad::all();
        $provincias = Provincia::all();
        $tecnicas = Tecnicamaterial::all();
        $ubicaciones = Ubicacion::all();

        // dd($ubicaciones);
        return view('patrimonio.formulario')->with(compact('departamentos', 'localidades', 'provincias', 'tecnicas', 'ubicaciones'));
    }
}
