<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function adiciona()
    {

    }

    public function ajaxElimina(Request $request)
    {
        // dd($request->all());
        $datosImagen = Imagen::find($request->idImagen);
        Imagen::destroy($request->idImagen);
        $imagenes = Imagen::where('patrimonio_id', $datosImagen->patrimonio_id)
                                ->get();

        return view('imagen.ajaxElimina')->with(compact('imagenes'));
    }
}
