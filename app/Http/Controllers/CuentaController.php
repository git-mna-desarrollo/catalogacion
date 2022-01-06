<?php

namespace App\Http\Controllers;

use App\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuentaController extends Controller
{
    public function listado(Request $request){

        $cuentas = Cuenta::all();

        return view('cuenta.listado')->with(compact('cuentas'));
    }

    public function guarda(Request $request){

        if($request->input('cuenta_id') == 0){

            $cuenta =  new Cuenta();

        }else{

            $id = $request->input('cuenta_id');
            $cuenta = Cuenta::find($id);
            
        }

        $cuenta->nombre = $request->input('nombre');

        $cuenta->save();

        return redirect('cuenta/listado');
    }

    public function elimina(Request $request, $cuenta_id){
        $cuenta = Cuenta::find($cuenta_id);

        $cuenta->eliminador_id = Auth::id();

        Cuenta::destroy($cuenta_id);

        return redirect('cuenta/listado');
    }
}
