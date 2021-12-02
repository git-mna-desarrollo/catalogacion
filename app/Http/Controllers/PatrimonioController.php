<?php

namespace App\Http\Controllers;

use App\Estado;
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
    public function formulario(Request $request, $idPatrimonio)
    {
        if($idPatrimonio != 0){
            $datosPatrimonio = Patrimonio::find($idPatrimonio);
        }else{
            $datosPatrimonio = null;
        }

        $tecnicas = Tecnicamaterial::all();
        $ubicaciones = Ubicacion::all();
        $especialidades = Especialidad::all();
        $estilos = Estilo::all();

        // dd($ubicaciones);
        return view('patrimonio.formulario')->with(compact('datosPatrimonio', 'tecnicas', 'ubicaciones', 'especialidades', 'estilos'));
    }

    public function guarda(Request $request)
    {
        // dd($request->all());

        if($request->filled('patrimonio_id')){
            $patrimonio = Patrimonio::find($request->input('patrimonio_id')); 
        }else{
            $patrimonio = new Patrimonio();
        }

        $patrimonio->creador_id                    = Auth::user()->id;
        $patrimonio->especialidad_id               = $request->input('especialidad_id');
        $patrimonio->estilo_id                     = $request->input('estilo_id');
        $patrimonio->ubicacion_id                  = $request->input('ubicacion_id');
        $patrimonio->tecnicamaterial_id            = $request->input('tecnicamaterial_id');
        $patrimonio->localidad                     = $request->input('localidad');
        $patrimonio->provincia                     = $request->input('provincia');
        $patrimonio->departamento                  = $request->input('departamento');
        $patrimonio->inmueble                      = $request->input('inmueble');
        $patrimonio->calle                         = $request->input('calle');
        $patrimonio->nombre                        = $request->input('nombre');
        $patrimonio->alto                          = $request->input('alto');
        $patrimonio->ancho                         = $request->input('ancho');
        $patrimonio->diametro                      = $request->input('diametro');
        $patrimonio->circunferencia                = $request->input('circunferencia');
        $patrimonio->largo                         = $request->input('largo');
        $patrimonio->profundidad                   = $request->input('profundidad');
        $patrimonio->peso                          = $request->input('peso');
        $patrimonio->escuela                       = $request->input('escuela');
        $patrimonio->epoca                         = $request->input('epoca');
        $patrimonio->autor                         = $request->input('autor');
        $patrimonio->inventario                    = $request->input('inventario');
        $patrimonio->codigo                        = $request->input('codigo');
        $patrimonio->inventario_anterior           = $request->input('inventario_anterior');
        $patrimonio->origen                        = $request->input('origen');
        $patrimonio->obtencion                     = $request->input('obtencion');
        $patrimonio->fecha_adquisicion             = $request->input('fecha_adquisicion');
        $patrimonio->marcas                        = $request->input('marcas');
        $patrimonio->descripcion                   = $request->input('descripcion');
        $patrimonio->especificacion_conservacion   = $request->input('especificacion_conservacion');
        $patrimonio->intervenciones_realizadas     = $request->input('intervenciones_realizadas');
        $patrimonio->caracteristicas_tecnicas      = $request->input('caracteristicas_tecnicas');
        $patrimonio->caracteristicas_iconograficas = $request->input('caracteristicas_iconograficas');
        $patrimonio->datos_historicos              = $request->input('datos_historicos');
        $patrimonio->referencias_bibliograficas    = $request->input('referencias_bibliograficas');
        $patrimonio->observaciones                 = $request->input('observaciones');
        $patrimonio->catalogo                      = $request->input('catalogo');
        $patrimonio->fec_catalogo                  = $request->input('fec_catalogo');
        $patrimonio->elaboro                       = $request->input('elaboro');
        $patrimonio->fec_elaboro                   = $request->input('fec_elaboro');
        $patrimonio->reviso                        = $request->input('reviso');
        $patrimonio->fec_reviso                    = $request->input('fec_reviso');
        $patrimonio->save();

        $patrimonioId = $patrimonio->id;

        // preguntamos el estado de conservacion
        if($request->has('monumento_nacional')){
            $monumento_nacional = 'Si';    
        }else{
            $monumento_nacional = 'No';    
        }

        if($request->has('resolucion_municipal')){
            $resolucion_municipal = 'Si';    
        }else{
            $resolucion_municipal = 'No';    
        }

        if($request->has('resolucion_administrativa')){
            $resolucion_administrativa = 'Si';    
        }else{
            $resolucion_administrativa = 'No';    
        }

        if($request->has('individual')){
            $individual = 'Si';    
        }else{
            $individual = 'No';    
        }

        if($request->has('conjunto')){
            $conjunto = 'Si';    
        }else{
            $conjunto = 'No';    
        }

        if($request->has('ninguna')){
            $ninguna = 'Si';    
        }else{
            $ninguna = 'No';    
        }

        if($request->filled('patrimonio_id')){
            $estados = Estado::where('patrimonio_id', $request->input('patrimonio_id'))
                                ->first(); 
        }else{
            $estados = new Estado();
        }

        $estados->patrimonio_id             = $patrimonioId;
        $estados->monumento_nacional        = $monumento_nacional;
        $estados->resolucion_municipal      = $resolucion_municipal;
        $estados->resolucion_administrativa = $resolucion_administrativa;
        $estados->individual                = $individual;
        $estados->conjunto                  = $conjunto;
        $estados->ninguna                   = $ninguna;
        $estados->estado_conservacion       = $request->input('estado_conservacion');
        $estados->condiciones_seguridad     = $request->input('condiciones_seguridad');
        $estados->save();

        // guardado de las imagenes
        if ($request->has('fotos')) 
        {
            foreach ($request->fotos as $key => $f) 
            {
                $archivo = $f;
                $direccion = 'imagenesProductos/'; // upload path
                $nombreArchivo = date('YmdHis').$key. "." . $archivo->getClientOriginalExtension();
                $archivo->move($direccion, $nombreArchivo);

                $imagenProducto              = new ImagenesProducto();
                $imagenProducto->user_id     = Auth::user()->id;
                $imagenProducto->producto_id = $producto_id;
                $imagenProducto->imagen      = $nombreArchivo;
                $imagenProducto->save();
            }
        }
        // fin guardado de las imagenes

        return redirect("patrimonio/listado");
    }   

    public function listado()
    {
        $tecnicas = Tecnicamaterial::all();
        $ubicaciones = Ubicacion::all();
        $especialidades = Especialidad::all();
        $estilos = Estilo::all();
        $autores = Patrimonio::select("autor")
                    ->groupBy("autor")
                    ->get();

        // foreach($autores as $a){
        //     echo $a->autor."<br />";
        // }

        // dd($autores);

        $patrimonios = Patrimonio::orderBy('id', 'desc')
                                ->limit(200)
                                ->get();

        return view('patrimonio.listado')->with(compact('patrimonios', 'tecnicas', 'ubicaciones', 'especialidades', 'estilos', 'autores'));
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

    public function ajaxBuscaPatrimonio(Request $request)
    {
        $patrimonios = Patrimonio::where('codigo', $request->input('codigo'))
                                    ->get();    

        return view('patrimonio.ajaxListado')->with(compact('patrimonios'));
    }

    public function ajaxListado(Request $request)
    {
        // dd($request->all());
        $qPatrimonios = Patrimonio::query();    

        if($request->filled('codigo')){
            $qPatrimonios->where('codigo', $request->input('codigo'));
        }

        if($request->filled('nombre')){
            $nombre = $request->input('nombre');
            $qPatrimonios->where('nombre', 'like', "%$nombre%");
        }

        if($request->filled('autor_busqueda')){
            $autor = $request->input('autor_busqueda');
            $qPatrimonios->where('autor', 'like', "%$autor%");
        }

        if($request->filled('especialidad_id')){
            $especialidad = $request->input('especialidad_id');
            $qPatrimonios->where('especialidad_id', "$especialidad");
        }

        if($request->filled('estilo_id')){
            $estilo = $request->input('estilo_id');
            $qPatrimonios->where('estilo_id', "$estilo");
        }

        if($request->filled('tecnicamaterial_id')){
            $tecnica = $request->input('tecnicamaterial_id');
            $qPatrimonios->where('tecnicamaterial_id', "$tecnica");
        }

        if(!$request->filled('codigo') && !$request->filled('nombre') && !$request->filled('autor_busqueda') && !$request->filled('especialidad_id') && !$request->filled('estilo_id') && !$request->filled('tecnicamaterial_id')){
            $qPatrimonios->orderBy('id', 'desc');
            $qPatrimonios->limit(200);
        }

        $patrimonios = $qPatrimonios->get();

        // dd($patrimonios);

        return view('patrimonio.ajaxListado')->with(compact('patrimonios'));
    
    }

}