<?php

namespace App\Http\Controllers;

use App\Sitio;
use Illuminate\Http\Request;

class SitioController extends Controller
{
    public function listado()
    {

        $sitios = Sitio::get();

        return view('sitio.listado')->with(compact('sitios'));        
    }

    public function guarda(Request $request)
    {

        if($request->filled('id')){
            $sitio = Sitio::find($request->input('id'));
        }else{
            $sitio = new Sitio();
        }
        
        $sitio->nombre = $request->input('nombre');
        $sitio->descripcion = $request->input('descripcion');
        $sitio->save();

        return redirect("sitio/listado");
    }

    public function elimina(Request $request, $id)
    {
        $sitio = Sitio::destroy($id);
        return redirect("sitio/listado");
    }
}
