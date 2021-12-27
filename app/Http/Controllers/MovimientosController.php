<?php

namespace App\Http\Controllers;

use App\User;
use App\Sitio;
use App\Ubicacion;
use App\Movimiento;
use App\Patrimonio;
use Illuminate\Http\Request;

class MovimientosController extends Controller
{
    public function inicio(Request $request, $patrimonioId)
    {
        // dd($patrimonioId);
        $usuarios = User::all();

        $ubicaciones = Ubicacion::all();

        $sitios = Sitio::all();
        
        $datosPatrimonio = Patrimonio::find($patrimonioId);

        $movimientos = Movimiento::where('patrimonio_id', $patrimonioId)
                                    ->get();    

        return view('movimiento.inicio')->with(compact('movimientos', 'datosPatrimonio', 'usuarios', 'ubicaciones', 'sitios'));
    }
}
