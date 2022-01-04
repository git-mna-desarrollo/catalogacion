<?php

namespace App\Http\Controllers;

use App\Inmueble;
use Illuminate\Http\Request;

class InmuebleController extends Controller
{
    public function listado(Request $request){

        $inmuebles = Inmueble::all();

        return view('inmueble.listado')->with(compact('inmuebles'));
    }

    public function guarda(Request $request){

        // dd($request->all());

        if($request->input('id') == 0){

            $inmueble = new Inmueble();

        }else{

            $id = $request->input('id');

            $inmueble = Inmueble::find($id);

        }
        
        $inmueble->nombre       = $request->input('nombre');
        $inmueble->descripcion  = $request->input('descripcion');

        $inmueble->save();

        return redirect('inmueble/listado');
    }

    public function elimina(Request $request, $inmueble_id){
        
        Inmueble::destroy($inmueble_id);

        return redirect('inmueble/listado');
    }
}
