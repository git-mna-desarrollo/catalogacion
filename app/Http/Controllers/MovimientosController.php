<?php

namespace App\Http\Controllers;

use App\User;
use App\Sitio;
use App\Ubicacion;
use App\Movimiento;
use App\Patrimonio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimientosController extends Controller
{
    public function listado(Request $request, $patrimonioId)
    {
        // dd($patrimonioId);
        $usuarios = User::all();

        $ubicaciones = Ubicacion::all();

        $sitios = Sitio::all();
        
        $datosPatrimonio = Patrimonio::find($patrimonioId);

        $movimientos = Movimiento::where('patrimonio_id', $patrimonioId)
                                    ->get();    

        return view('movimiento.listado')->with(compact('movimientos', 'datosPatrimonio', 'usuarios', 'ubicaciones', 'sitios'));
    }

    public function guarda(Request $request)
    {
        // dd($request->input());
        $patrimonio_id = $request->input('patrimonio_id');

        $movimiento                = new Movimiento();
        $movimiento->creador_id    = Auth::user()->id;
        $movimiento->patrimonio_id = $request->input('patrimonio_id');
        $movimiento->asignado_id   = $request->input('asignado_id');
        $movimiento->destino_id    = $request->input('destino_id');
        $movimiento->sitio_id      = $request->input('sitio_id');
        $movimiento->observaciones = $request->input('observaciones');
        $movimiento->save();

        return redirect("movimiento/listado/$patrimonio_id");
    }
}
