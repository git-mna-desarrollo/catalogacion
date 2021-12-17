<?php

namespace App\Http\Controllers;

use App\Estilo;
use Illuminate\Http\Request;

class EstiloController extends Controller
{
    public function listado(){

        $estilos = Estilo::get();

        return view('estilo.listado')->with(compact('estilos'));        
    }

    public function guarda(Request $request){

        if($request->filled('id')){
            $estilo = Estilo::find($request->input('id'));
        }else{
            $estilo = new Especialidad();
        }
        
        $estilo->nombre = $request->input('nombre');
        $estilo->descripcion = $request->input('descripcion');
        $estilo->save();

        return redirect("estilo/listado");
    }

    public function elimina(Request $request, $id)
    {
        $estilo = Estilo::destroy($id);
        return redirect("estilo/listado");
    }

}
