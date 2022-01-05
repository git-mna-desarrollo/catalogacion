<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\SubEspecialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubEspecialidadController extends Controller
{
    public function listado(Request $request, $especialidad_id){

        $subespecialidades =  SubEspecialidad::where('especialidad_id',$especialidad_id)->get();

        $especialidad = Especialidad::find($especialidad_id);

        return view('subespecialidad.listado')->with(compact('subespecialidades','especialidad'));
    }
    
    public function guarda(Request $request){

        // dd($request->all());

        $subespecialidad = new SubEspecialidad();
        
        $subespecialidad->creador_id        = Auth::user()->id;
        $subespecialidad->especialidad_id   = $request->input('subesp_id');
        $subespecialidad->nombre            = $request->input('subesp_nombre');

        $subespecialidad->save();
        
        return redirect('subespecialidad/listado/'.$subespecialidad->especialidad_id);

    }

    public function elimina(Request $request, $subespecialidad_id){

        $especialidad_id = SubEspecialidad::find($subespecialidad_id)->especialidad_id;
        // dd($especialidad_id);

        SubEspecialidad::destroy($subespecialidad_id);

        return redirect('subespecialidad/listado/'.$especialidad_id);
    }
}
