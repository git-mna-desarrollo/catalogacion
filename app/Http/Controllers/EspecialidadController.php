<?php

namespace App\Http\Controllers;

use App\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function listado(){

        $especialidades = Especialidad::get();

        return view('especialidad.listado')->with(compact('especialidades'));        
    }

    public function guarda(Request $request){

        if($request->filled('id')){
            $especialidad = Especialidad::find($request->input('id'));
        }else{
            $especialidad = new Especialidad();
        }
        
        $especialidad->nombre = $request->input('nombre');
        $especialidad->descripcion = $request->input('descripcion');
        $especialidad->save();

        return redirect("especialidad/listado");
    }

    public function elimina(Request $request, $id)
    {
        $especialidad = Especialidad::destroy($id);
        return redirect("especialidad/listado");
    }
}