<?php

namespace App\Http\Controllers;

use App\Tecnicamaterial;
use Illuminate\Http\Request;

class TecnicamaterialController extends Controller
{
    public function listado(){

        $tecnicam = Tecnicamaterial::get();

        return view('tecnicamaterial.listado')->with(compact('tecnicam'));        
    }

    public function guarda(Request $request){

        if($request->filled('id')){
            $tecnicam = Tecnicamaterial::find($request->input('id'));
        }else{
            $tecnicam = new Tecnicamaterial();
        }
        
        $tecnicam->nombre = $request->input('nombre');
        $tecnicam->descripcion = $request->input('descripcion');
        $tecnicam->save();

        return redirect("tecnicamaterial/listado");
    }

    public function elimina(Request $request, $id)
    {
        $tecnicam = Tecnicamaterial::destroy($id);
        return redirect("tecnicamaterial/listado");
    }

}