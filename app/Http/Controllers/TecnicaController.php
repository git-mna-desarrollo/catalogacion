<?php

namespace App\Http\Controllers;

use App\Tecnica;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Auth;

class TecnicaController extends Controller
{
    public function listado(Request $request){
        $tecnicas = Tecnica::all();

        return view('tecnica.listado')->with(compact('tecnicas'));        
        
    }

    public function guarda(Request $request){
        // dd($request->all());
        if($request->input('tecnica_id') == 0){
            $tecnica = new Tecnica();

            $tecnica->creador_id = Auth::id();
        }else{
            $id = $request->input('tecnica_id');
            $tecnica = Tecnica::find($id);

            $tecnica->modificador_id = Auth::id();
        }

        $tecnica->nombre = $request->input('nombre');

        $tecnica->save();

        return redirect('tecnica/listado');

    }

    public function elimina(Request $request){

    }
}
