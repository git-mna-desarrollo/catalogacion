<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    public function listado(){

        $ubicaciones = Ubicacion::get();

        return view('ubicacion.listado')->with(compact('ubicaciones'));        
    }

    public function guarda(Request $request){

        if($request->filled('id')){
            $ubicacion = Ubicacion::find($request->input('id'));
        }else{
            $ubicacion = new Ubicacion();
        }
        
        $ubicacion->nombre = $request->input('nombre');
        $ubicacion->descripcion = $request->input('descripcion');
        $ubicacion->save();

        return redirect("ubicacion/listado");
    }

    public function elimina(Request $request, $id)
    {
        $estilo = Ubicacion::destroy($id);
        return redirect("ubicacion/listado");
    }

}
