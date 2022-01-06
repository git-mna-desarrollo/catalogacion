<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function listado(Request $request){

        $materiales = Material::all();

        return view('material.listado')->with(compact('materiales'));
    }

    public function guarda(Request $request){
        // dd($request->all());

        if($request->input('material_id') == 0){
            $material = new Material();

            $material->creador_id = Auth::id();
        }else{
            $id = $request->input('material_id');
            $material = Material::find($id);
            $material->modificador_id = Auth::id();
        }

        $material->nombre = $request->input('nombre');

        $material->save();

        return redirect('material/listado');
    }

    public function elimina(Request $request, $material_id){
        $material = Material::find($material_id);

        $material->eliminador_id = Auth::id();

        $material->save();

        Material::destroy($material_id);
        
        return redirect('material/listado');
    }
}
