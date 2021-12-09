<?php

namespace App\Http\Controllers;

use App\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function ajaxElimina(Request $request)
    {
        $datosDocumento = Documento::find($request->id);

        Documento::destroy($request->id);

        $documentos = Documento::where('patrimonio_id', $datosDocumento->patrimonio_id)
                                ->get();

        return view('documento.ajaxElimina')->with(compact('documentos'));
    }
}
