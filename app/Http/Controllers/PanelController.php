<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use App\Patrimonio;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio()
    {
        $cantidadPatrimonios = Patrimonio::count();

        // dd($cantidadPatrimonios);
        
        return view('panel.inicio')->with(compact('cantidadPatrimonios'));
    }
}
