<?php

namespace App\Http\Controllers;

use App\Estilo;
use App\Localidad;
use App\Provincia;
use App\Ubicacion;
use App\Patrimonio;
use App\Departamento;
use App\Especialidad;
use App\Tecnicamaterial;
use Illuminate\Http\Request;
use App\Imports\PatrimoniosImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PatrimonioController extends Controller
{
    public function formulario()
    {
        $tecnicas = Tecnicamaterial::all();
        $ubicaciones = Ubicacion::all();
        $especialidades = Especialidad::all();
        $estilos = Estilo::all();

        // dd($ubicaciones);
        return view('patrimonio.formulario')->with(compact('tecnicas', 'ubicaciones', 'especialidades', 'estilos'));
    }

    public function guarda(Request $request)
    {
        dd($request->all());
        $patrimonio                                = new Patrimonio();
        $patrimonio->creador_id                    = Auth::user()->id;
        $patrimonio->localidad                     = $request->input('localidad');
        $patrimonio->provincia                     = $request->input('provincia');
        $patrimonio->departamento_id               = $request->input('departamento');
        $patrimonio->inmueble                      = $request->input('inmueble');
        $patrimonio->calle                         = $request->input('calle');
        $patrimonio->ubicacion_id                  = $request->input('ubicacion_id');
        $patrimonio->tecnicamaterial_id            = $request->input('tecnicamaterial_id');
        $patrimonio->direccion                     = $request->input('direccion');
        $patrimonio->nombre                        = $request->input('nombre');
        $patrimonio->alto                          = $request->input('alto');
        $patrimonio->ancho                         = $request->input('ancho');
        $patrimonio->diametro                      = $request->input('diametro');
        $patrimonio->circunferencia                = $request->input('circunferencia');
        $patrimonio->largo                         = $request->input('largo');
        $patrimonio->profundidad                   = $request->input('profundidad');
        $patrimonio->peso                          = $request->input('peso');
        $patrimonio->especialidad                  = $request->input('especialidad');
        $patrimonio->estilo                        = $request->input('estilo');
        $patrimonio->escuela                       = $request->input('escuela');
        $patrimonio->epoca                         = $request->input('epoca');
        $patrimonio->autor                         = $request->input('autor');
        $patrimonio->inventario                    = $request->input('inventario');
        $patrimonio->codigo                        = $request->input('codigo');
        $patrimonio->codigo_antiguo                = $request->input('codigo_antiguo');
        $patrimonio->inventario_anterior           = $request->input('inventario_anterior');
        $patrimonio->origen                        = $request->input('origen');
        $patrimonio->obtencion                     = $request->input('obtencion');
        $patrimonio->fecha_adquisicion             = $request->input('fecha_adquisicion');
        $patrimonio->marcas                        = $request->input('marcas');
        $patrimonio->descripcion                   = $request->input('descripcion');
        $patrimonio->estado_conservacion           = $request->input('estado_conservacion');
        $patrimonio->intervenciones_realizadas     = $request->input('intervenciones_realizadas');
        $patrimonio->caracteristicas_tecnicas      = $request->input('caracteristicas_tecnicas');
        $patrimonio->caracteristicas_iconograficas = $request->input('caracteristicas_iconograficas');
        $patrimonio->datos_historicos              = $request->input('datos_historicos');
        $patrimonio->referencias_bibliograficas    = $request->input('referencias_bibliograficas');
        $patrimonio->observaciones                 = $request->input('observaciones');
        $patrimonio->save();

        $patrimonioId = $patrimonio->id;

        $estados = new Estado();
        $estados->creador_id = Auth::user()->id;
        $estados->monumento_nacional = $request->input('monumento_nacional');

        return redirect("patrimonio/listado");
    }   

    public function listado()
    {

        
        $patrimonios = Patrimonio::orderBy('id', 'desc')
                                ->limit(200)
                                ->get();

        // dd($patrimonios);

        return view('patrimonio.listado')->with(compact('patrimonios'));
    }

    public function elimina(Request $request, $id)
    {
        $patrimonio = Patrimonio::destroy($id);
        return redirect("patrimonio/listado");
    }

    public function migracion()
    {
        $archivo = public_path("c.xlsx");
        Excel::import(new PatrimoniosImport, $archivo);
    }

    public function ficha(Request $request, $patrimonioId)
    {
        $patrimonio = Patrimonio::find($patrimonioId);
        return view('patrimonio.ficha')->with(compact('patrimonio'));
    }

}
