<?php

namespace App\Http\Controllers;

use PDF;
use App\Sitio;
use App\Cuenta;
use App\Estado;
use App\Estilo;
use App\Imagen;
use App\Tecnica;
use App\Inmueble;
use App\Material;
use App\Revision;
use App\Documento;
use App\Localidad;
use App\Provincia;
use App\Ubicacion;
use App\Patrimonio;
use App\Departamento;
use App\Especialidad;
use App\Modificacion;
use App\SubEspecialidad;
use App\Tecnicamaterial;
use Illuminate\Http\Request;
use App\Imports\PatrimoniosImport;

//para creacion de excel
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class PatrimonioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // formulario de registro de patrimonios
    public function formulario(Request $request, $idPatrimonio)
    {
        // preguntamos si es uno nuevo
        // para enviar datos al formulario
        if($idPatrimonio != 0){

            // por verdad enviamos los datos para editar
            $datosPatrimonio = Patrimonio::find($idPatrimonio);

            $imagenes = Imagen::where('patrimonio_id', $datosPatrimonio->id)
                        ->get();

            $documentos = Documento::where('patrimonio_id', $datosPatrimonio->id)
                        ->get();

            $provincias = Provincia::where('departamento', $datosPatrimonio->departamento)->get();

            $subespecialidades = SubEspecialidad::where('especialidad_id',$datosPatrimonio->especialidad_id)->get();
            // dd($provincias);

        }else{
            // de lo contrario se envian datos como null
            $datosPatrimonio = null;
            $imagenes = null;
            $documentos = null;
            $subespecialidades = null;
            $provincias = Provincia::where('departamento','LA PAZ')->get();
        }

        // mandamos los datos de los combos al formulario
        $sitios = Sitio::all();
        $tecnicas = Tecnicamaterial::all();
        $ubicaciones = Ubicacion::all();
        $especialidades = Especialidad::all();
        $estilos = Estilo::all();
        $inmuebles = Inmueble::all();

        $cuentas = Cuenta::all();

        $tecnicasSep = Tecnica::all();
        $materiales = Material::all();


        return view('patrimonio.formulario')->with(compact('datosPatrimonio', 'tecnicas', 'ubicaciones', 'especialidades', 'estilos', 'imagenes', 'documentos', 'sitios', 'provincias', 'inmuebles', 'tecnicasSep', 'materiales', 'subespecialidades', 'cuentas'));
    }

    public function guarda(Request $request)
    {

        // dd($request->all());

        // preguntamos si el campo patrimonio existe
        if($request->filled('patrimonio_id')){
            // si existe habilitamos la edicion
            $patrimonio = Patrimonio::find($request->input('patrimonio_id')); 
        }else{
            // si no existe creamos uno nuevo
            $patrimonio = new Patrimonio();
            $patrimonio->estado = 'CATALOGACION';
        }
        // seteamos los datos para el formulario
        $patrimonio->creador_id                    = Auth::user()->id;
        $patrimonio->especialidad_id               = $request->input('especialidad_id');
        $patrimonio->subespecialidad_id            = $request->input('subEspecialidad');
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
        $patrimonio->cuenta_id                     = $request->input('cuenta_id');
        $patrimonio->sub_cuenta                    = $request->input('sub_cuenta');        

        $tecnicas = '';

        if($request->input('tecnica_1') != null){
            $tecnicas = $tecnicas.$request->input('tecnica_1');
        }

        if($request->input('tecnica_2') != null){
            $tecnicas = $tecnicas."/".$request->input('tecnica_2');
        }

        if($request->input('tecnica_3') != null){
            $tecnicas = $tecnicas."/".$request->input('tecnica_3');
        }

        $patrimonio->tecnicas = $tecnicas;

        $materiales = '';

        if($request->input('material_1') != null){
            $materiales = $materiales.$request->input('material_1');
        }

        if($request->input('material_2') != null){
            $materiales = $materiales."/".$request->input('material_2');
        }

        if($request->input('material_3') != null){
            $materiales = $materiales."/".$request->input('material_3');
        }

        $patrimonio->materiales = $materiales;

        // para los logs
        // preguntamos si existe algun cambio en los datos
        if($patrimonio->isDirty()){
            $modificacion = new Modificacion();
            $modificacion->patrimonio_id = $patrimonio->id;
            $modificacion->user_id = Auth::user()->id;
        }

        // preguntamos si departamento cambio
        if($patrimonio->isDirty('departamento')){
            $modificacion->campo = 'DEPARTAMENTO';
            $modificacion->dato_anterior = $patrimonio->getOriginal('departamento');
            $modificacion->dato_modificado = $request->input('departamento');
        }

        // preguntamos si existe cambio para guardar los datos
        if($patrimonio->isDirty()){
            $modificacion->save();
        }

        // fin para los logs
        $patrimonio->save();

        $patrimonioId = $patrimonio->id;

        if($request->filled('trabajo_terminado')){
            $revision = new Revision();

            $revision->creador_id = Auth::user()->id;
            $revision->patrimonio_id = $patrimonioId;

            // catalogador, revisor, aprobador
            if(Auth::user()->tipo == 'Catalogador'){
                $revision->estado = 'CATALOGACION';
                $revision->terminado = 'Si';

                $modPatrimonio = Patrimonio::find($patrimonioId);
                $modPatrimonio->estado = 'REVISION';
                $modPatrimonio->save();

            }else if(Auth::user()->tipo == 'Revisor'){
                $revision->estado = 'REVISION';
                $revision->terminado = 'Si';
                
                $modPatrimonio = Patrimonio::find($patrimonioId);
                $modPatrimonio->estado = 'APROBACION';
                $modPatrimonio->save();

            }else{
                $revision->estado = 'APROBACION';
                $revision->terminado = 'Si';

                $modPatrimonio = Patrimonio::find($patrimonioId);
                $modPatrimonio->estado = 'APROBADO';
                $modPatrimonio->save();

                // aqui poner el json de la ficha

            }

            $revision->save();
        }
        
        // $patrimonio->isDirty('especialidad_id');

        // preguntamos el check de monumento_nacional
        if($request->has('monumento_nacional')){
            $monumento_nacional = 'Si';    
        }else{
            $monumento_nacional = 'No';    
        }
        // preguntamos el chaeck de la resolucion_municipal
        if($request->has('resolucion_municipal')){
            $resolucion_municipal = 'Si';    
        }else{
            $resolucion_municipal = 'No';    
        }
        // preguntamos el chaeck de resolucion_administrativa
        if($request->has('resolucion_administrativa')){
            $resolucion_administrativa = 'Si';    
        }else{
            $resolucion_administrativa = 'No';    
        }
        // preguntamos el chaeck de individual
        if($request->has('individual')){
            $individual = 'Si';    
        }else{
            $individual = 'No';    
        }
        // preguntamos el chaeck de conjunto
        if($request->has('conjunto')){
            $conjunto = 'Si';    
        }else{
            $conjunto = 'No';    
        }
        // preguntamos el chaeck de ninguna
        if($request->has('ninguna')){
            $ninguna = 'Si';    
        }else{
            $ninguna = 'No';    
        }
        // preguntamos existe el patrimonio
        // para guardar los estados
        if($request->filled('patrimonio_id')){
            // si existe editamos
            $estados = Estado::where('patrimonio_id', $request->input('patrimonio_id'))
                                ->first(); 
            if($estados != null){
                $estados = Estado::where('patrimonio_id', $request->input('patrimonio_id'))
                                ->first();
            }else{
                $estados = new Estado();
            }
        }else{
            // si no existe creamos uno nuevo
            $estados = new Estado();
        }

        // seteamos los datos para guardar
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
        if ($request->has('archivo')) 
        {
            foreach ($request->archivo as $key => $f) 
            {

                $archivo = $f;
                $direccion = 'imagenes/'; // upload path
                $nombreArchivo = date('YmdHis').$key. "." . $archivo->getClientOriginalExtension();
                $archivo->move($direccion, $nombreArchivo);

                $imagenProducto              = new Imagen();
                if($request->input('imagen_en_ficha') == $key){
                    $imagenProducto->estado = 'Ficha';
                }
                $imagenProducto->creador_id  = Auth::user()->id;
                $imagenProducto->patrimonio_id = $patrimonioId;
                $imagenProducto->imagen      = $nombreArchivo;
                $imagenProducto->save();
            }
        }
        // fin guardado de las imagenes

        // guardado de los documentos
        if ($request->has('documento')) 
        {
            foreach ($request->documento as $key => $f) 
            {
                $archivo = $f;
                $direccion = 'documentos/'; // upload path
                $nombreArchivo = date('YmdHis').$key. "." . $archivo->getClientOriginalExtension();
                $archivo->move($direccion, $nombreArchivo);

                $imagenProducto                = new Documento();
                $imagenProducto->creador_id    = Auth::user()->id;
                $imagenProducto->patrimonio_id = $patrimonioId;
                $imagenProducto->nombre        = $request->input("nombre_documento.$key");
                $imagenProducto->documento     = $nombreArchivo;
                $imagenProducto->save();
            }
        }
        // fin guardado de las documentos
        return redirect("patrimonio/listado");
    }   

    public function listado()
    {
        // extremos los datos para los combos de las busquedas
        $tecnicas = Tecnicamaterial::all();
        $ubicaciones = Ubicacion::all();
        $especialidades = Especialidad::all();
        $estilos = Estilo::all();

        $epocas = Patrimonio::select("epoca")
                            ->groupBy('epoca')
                            ->get();

        $autores = Patrimonio::select("autor")
                    ->groupBy("autor")
                    ->get();

        $patrimonios = Patrimonio::orderBy('id', 'desc')
                                ->limit(200)
                                ->get();

        $materiales =  Patrimonio::select('materiales')
                                ->whereNotNull('materiales')
                                ->groupBy('materiales')
                                ->get();

        $tecnicas =  Patrimonio::select('tecnicas')
                                ->whereNotNull('tecnicas')
                                ->groupBy('tecnicas')
                                ->get();

        return view('patrimonio.listado')->with(compact('patrimonios', 'tecnicas', 'ubicaciones', 'especialidades', 'estilos', 'autores', 'epocas', 'materiales', 'tecnicas'));
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
            $codigo = $request->input('codigo');
            $qPatrimonios->where('codigo', 'like', "%$codigo");
        }

        if($request->filled('codigo_administrativo')){
            $codigo_administrativo = $request->input('codigo_administrativo');
            $qPatrimonios->where('codigo_administrativo', 'like', "$codigo_administrativo");
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

        if($request->filled('materiales')){
            $materiales = $request->input('materiales');
            $qPatrimonios->where('materiales', 'like',"%$materiales%");
        }

        if($request->filled('tecnicas')){
            $tecnicas = $request->input('tecnicas');
            $qPatrimonios->where('tecnicas', 'like',"%$tecnicas%");
        }

        // if($request->filled('tecnicamaterial_id')){
        //     $tecnica = $request->input('tecnicamaterial_id');
        //     $qPatrimonios->where('tecnicamaterial_id', "$tecnica");
        // }

        if($request->filled('epoca_busqueda')){
            $epoca = $request->input('epoca_busqueda');
            $qPatrimonios->where('epoca', "$epoca");
        }

        if(!$request->filled('codigo') && !$request->filled('nombre') && !$request->filled('autor_busqueda') && !$request->filled('especialidad_id') && !$request->filled('estilo_id') && !$request->filled('tecnicamaterial_id')){
            $qPatrimonios->orderBy('id', 'desc');
            $qPatrimonios->limit(200);
        }

        $patrimonios = $qPatrimonios->get();

        // dd($patrimonios);

        return view('patrimonio.ajaxListado')->with(compact('patrimonios'));
    
    }

    public function impresion(Request $request, $patrimonioId)
    {
        // dd($patrimonioId);
        // Generate PDF
        // retreive all records from db
        $patrimonio = Patrimonio::find($patrimonioId);
        // dd($patrimonio);
        // share data to view
        view()->share('patrimonio',$patrimonio);
        $pdf = PDF::loadView('pdf.ficha', $patrimonio);
        $pdf->setPaper('Legal', 'portrait');

        // download PDF file with download method
        return $pdf->stream('ficha.pdf');
    
        // return view('patrimonio.ficha')->with(compact('patrimonio'));
    }

    public function ajaxBuscaProvincia(Request $request){

        $provincias = Provincia::where('departamento',$request->input('provincia'))
                                ->get();

        return view('patrimonio.ajaxBuscaProvincia')->with(compact('provincias'));

    }

    public function ajaxBuscaSubEspecialidad(Request $request){

        $subespecialidades =  SubEspecialidad::where('especialidad_id',$request->input('valorSlecionado'))
                                            ->get();

        return view('patrimonio.ajaxBuscaSubEspecialidad')->with(compact('subespecialidades'));
    }

    public function generaExcel(Request $request)
    {
        // buscamos los patrimonios
                $qPatrimonios = Patrimonio::query();    

        if($request->filled('codigo')){
            $codigo = $request->input('codigo');
            $qPatrimonios->where('codigo', 'like', "%$codigo");
        }

        if($request->filled('codigo_administrativo')){
            $codigo_administrativo = $request->input('codigo_administrativo');
            $qPatrimonios->where('codigo_administrativo', 'like', "$codigo_administrativo");
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

        if($request->filled('materiales')){
            $materiales = $request->input('materiales');
            $qPatrimonios->where('materiales', 'like',"%$materiales%");
        }

        if($request->filled('tecnicas')){
            $tecnicas = $request->input('tecnicas');
            $qPatrimonios->where('tecnicas', 'like',"%$tecnicas%");
        }

        // if($request->filled('tecnicamaterial_id')){
        //     $tecnica = $request->input('tecnicamaterial_id');
        //     $qPatrimonios->where('tecnicamaterial_id', "$tecnica");
        // }

        if($request->filled('epoca_busqueda')){
            $epoca = $request->input('epoca_busqueda');
            $qPatrimonios->where('epoca', "$epoca");
        }

        $patrimonios = $qPatrimonios->get();

        // generacion del excel
        $fileName = 'patrimonios.xlsx';
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle("certifica_cal");
        $sheet = $spreadsheet->getActiveSheet();

        //colocamos los valores en el excel
        $sheet->setCellValue('A1', 'LISTADO DE PATRIMONIOS');

        $sheet->setCellValue('A2', 'CODIGO ADM');
        $sheet->setCellValue('B2', 'CODIGO');
        $sheet->setCellValue('C2', 'TITULO');
        $sheet->setCellValue('D2', 'AUTOR');
        $sheet->setCellValue('E2', 'EPOCA');
        $sheet->setCellValue('F2', 'ESPECIALIDAD');
        $sheet->setCellValue('G2', 'ESTILO');
        $sheet->setCellValue('H2', 'TECNICAS');
        $sheet->setCellValue('I2', 'MATERIALES');

        $contadorCeldas = 3;
        foreach ($patrimonios as $key => $p) {

            $sheet->setCellValue("A$contadorCeldas", $p->codigo_administrativo);
            $sheet->setCellValue("B$contadorCeldas", $p->codigo);
            $sheet->setCellValue("C$contadorCeldas", $p->nombre);
            $sheet->setCellValue("D$contadorCeldas", $p->autor);
            $sheet->setCellValue("E$contadorCeldas", $p->epoca);
            $sheet->setCellValue("F$contadorCeldas", ($p->especialidad_id != null)?$p->especialidad->nombre:'');
            $sheet->setCellValue("G$contadorCeldas", ($p->estilo_id != null)?$p->estilo->nombre:'');
            $sheet->setCellValue("H$contadorCeldas", ($p->tecnicamaterial_id != null)?$p->tecnicas:'');
            $sheet->setCellValue("I$contadorCeldas", ($p->tecnicamaterial_id != null)?$p->materiales:'');


            $contadorCeldas++;
        }

        //definimos los estilos

        // fusionamos las celdas para el titulo
        $sheet->mergeCells("A1:I1");

        // estilo para el titulo principal
        $fuenteNegritaTitulo = array(
            'font'  => array(
                'bold'  => true,
                // 'color' => array('rgb' => 'FF0000'),
                'size'  => 14,
                'name'  => 'Verdana'
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        );

        $spreadsheet->getActiveSheet()->getStyle("A1")->applyFromArray($fuenteNegritaTitulo);

        // titulos encabezados en negrita
        $fuenteNegrita = array(
            'font'  => array(
                'bold'  => true,
                // 'color' => array('rgb' => 'FF0000'),
                'size'  => 10,
                'name'  => 'Verdana'
            ));

        $spreadsheet->getActiveSheet()->getStyle("A2:I2")->applyFromArray($fuenteNegrita);

        // ancho de las columnas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(30);

        // colocamos los bordes
        $bordeCeldas = --$contadorCeldas;
        $spreadsheet->getActiveSheet()->getStyle("A2:I$$bordeCeldas")->applyFromArray(
            array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => array('argb' => '000000')
                    )
                )
            )
        );

        
        // exportamos el excel
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
    }

    public function revisiones(){

        // regularizacion revisiones
        /*$patrimonios = Patrimonio::all();

        foreach ($patrimonios as $p){
            $rev = new Revision();
            $rev->creador_id = Auth::user()->id;
            $rev->patrimonio_id = $p->id;
            $rev->estado = "CATALOGACION";
            $rev->terminado = "No";
            $rev->save();
        }*/

        $autores = Patrimonio::select("autor")
                    ->groupBy("autor")
                    ->get();

        $patrimonios = Patrimonio::orderBy('id', 'desc')
                                ->limit(200)
                                ->get();

        return view('patrimonio.revisiones')->with(compact('patrimonios', 'autores'));
       
    }

    public function ajaxListadoRevisiones(Request $request){
                // dd($request->all());
        $qPatrimonios = Patrimonio::query();    

        if($request->filled('codigo')){
            $codigo = $request->input('codigo');
            $qPatrimonios->where('codigo', 'like', "%$codigo");
        }

        if($request->filled('codigo_administrativo')){
            $codigo_administrativo = $request->input('codigo_administrativo');
            $qPatrimonios->where('codigo_administrativo', 'like', "$codigo_administrativo");
        }

        if($request->filled('nombre')){
            $nombre = $request->input('nombre');
            $qPatrimonios->where('nombre', 'like', "%$nombre%");
        }

        if($request->filled('autor_busqueda')){
            $autor = $request->input('autor_busqueda');
            $qPatrimonios->where('autor', 'like', "%$autor%");
        }

        if(!$request->filled('codigo') && !$request->filled('nombre') && !$request->filled('autor_busqueda') && !$request->filled('especialidad_id') && !$request->filled('estilo_id') && !$request->filled('tecnicamaterial_id')){
            $qPatrimonios->orderBy('id', 'desc');
            $qPatrimonios->limit(200);
        }

        if(Auth::user()->tipo == 'Catalogador'){
            $qPatrimonios->where('estado', "CATALOGACION");
        }else if(Auth::user()->tipo == 'Revisor'){
            $qPatrimonios->where('estado', "REVISION");
        }else if(Auth::user()->tipo == 'Aprobador'){
            $qPatrimonios->where('estado', "APROBADO");
        }else{
            $qPatrimonios->whereNull('estado');
        }

        $patrimonios = $qPatrimonios->get();

        // dd($patrimonios);

        return view('patrimonio.ajaxListadoRevisiones')->with(compact('patrimonios'));

    }

    public function capturaCheck(Request $request)
    {
        // dd($request->all());
        $campos = array();

        if($request->filled('codigo')){
            $campos[]='codigo';
        }       

        if($request->filled('codigo_administrativo')){
            $campos[]='codigo_administrativo';
        }       

        if($request->filled('nombre')){
            $campos[]='nombre';
        }       

        if($request->filled('autor')){
            $campos[]='autor';
        }     
        
        $contador = count($campos);
        $contadorLetras = 65;

        for($i=0; $i < $contador; $i++){
            echo $campos[$i]."-".chr($contadorLetras)."<br />";
            $contadorLetras++;
        }

        // dd(count($campos));

    }

    public function listadoCuentas(Request $request){
     
        // extremos los datos para los combos de las busquedas
        $tecnicas = Tecnicamaterial::all();
        $ubicaciones = Ubicacion::all();
        $especialidades = Especialidad::all();
        $estilos = Estilo::all();

        $epocas = Patrimonio::select("epoca")
                            ->groupBy('epoca')
                            ->get();

        $autores = Patrimonio::select("autor")
                    ->groupBy("autor")
                    ->get();

        $patrimonios = Patrimonio::orderBy('id', 'desc')
                                ->limit(200)
                                ->get();

        $materiales =  Patrimonio::select('materiales')
                                ->whereNotNull('materiales')
                                ->groupBy('materiales')
                                ->get();

        $tecnicas =  Patrimonio::select('tecnicas')
                                ->whereNotNull('tecnicas')
                                ->groupBy('tecnicas')
                                ->get();

        $cuentas = Patrimonio::whereNotNull('cuenta_id')
                                ->distinct('cuenta_id')
                                ->get('cuenta_id');

        return view('patrimonio.listadoCuentas')->with(compact('patrimonios', 'tecnicas', 'ubicaciones', 'especialidades', 'estilos', 'autores', 'epocas', 'materiales', 'tecnicas', 'cuentas'));   
    }

    public function ajaxListadoCuentas(Request $request){
        // dd($request->all());
        $qPatrimonios = Patrimonio::query();    

        if($request->filled('codigo')){
            $codigo = $request->input('codigo');
            $qPatrimonios->where('codigo', 'like', "%$codigo");
        }

        if($request->filled('codigo_administrativo')){
            $codigo_administrativo = $request->input('codigo_administrativo');
            $qPatrimonios->where('codigo_administrativo', 'like', "$codigo_administrativo");
        }

        if($request->filled('nombre')){
            $nombre = $request->input('nombre');
            $qPatrimonios->where('nombre', 'like', "%$nombre%");
        }

        if($request->filled('autor_busqueda')){
            $autor = $request->input('autor_busqueda');
            $qPatrimonios->where('autor', 'like', "%$autor%");
        }

        if($request->filled('cuenta_busqueda')){
            $cuenta = $request->input('cuenta_busqueda');
            $qPatrimonios->where('cuenta_id', "$cuenta");
        }

        if($request->filled('subcuenta_busqueda')){
            $subcuenta = $request->input('subcuenta_busqueda');
            $qPatrimonios->where('sub_cuenta','like', "%$subcuenta%");
        }

        if(!$request->filled('codigo') && !$request->filled('nombre') && !$request->filled('autor_busqueda') && !$request->filled('cuenta_busqueda') && !$request->filled('subcuenta_busqueda')){
            $qPatrimonios->orderBy('id', 'desc');
            $qPatrimonios->limit(200);
        }

        $patrimonios = $qPatrimonios->get();

        return view('patrimonio.ajaxListadoCuentas')->with(compact('patrimonios'));
    }

    public function generaExcelCuentas(Request $request){
        // buscamos los patrimonios
        $qPatrimonios = Patrimonio::query();    

        if($request->filled('codigo')){
            $codigo = $request->input('codigo');
            $qPatrimonios->where('codigo', 'like', "%$codigo");
        }

        if($request->filled('codigo_administrativo')){
            $codigo_administrativo = $request->input('codigo_administrativo');
            $qPatrimonios->where('codigo_administrativo', 'like', "$codigo_administrativo");
        }

        if($request->filled('nombre')){
            $nombre = $request->input('nombre');
            $qPatrimonios->where('nombre', 'like', "%$nombre%");
        }

        if($request->filled('autor_busqueda')){
            $autor = $request->input('autor_busqueda');
            $qPatrimonios->where('autor', 'like', "%$autor%");
        }

        if($request->filled('cuenta_busqueda')){
            $cuenta = $request->input('cuenta_busqueda');
            $qPatrimonios->where('cuenta_id', "$cuenta");
        }

        if($request->filled('subcuenta_busqueda')){
            $subcuenta = $request->input('subcuenta_busqueda');
            $qPatrimonios->where('sub_cuenta','like', "%$subcuenta%");
        }

        $patrimonios = $qPatrimonios->get();

        // generacion del excel
        $fileName = 'patrimoniosCuentas.xlsx';
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle("certifica_cal");
        $sheet = $spreadsheet->getActiveSheet();

        //colocamos los valores en el excel
        $sheet->setCellValue('A1', 'LISTADO DE PATRIMONIOS D CUENTAS');

        $sheet->setCellValue('A2', 'CODIGO ADM');
        $sheet->setCellValue('B2', 'CODIGO');
        $sheet->setCellValue('C2', 'TITULO');
        $sheet->setCellValue('D2', 'AUTOR');
        $sheet->setCellValue('E2', 'CUENTA');
        $sheet->setCellValue('F2', 'SUB CUENTA');

        $contadorCeldas = 3;
        foreach ($patrimonios as $key => $p) {
            $sheet->setCellValue("A$contadorCeldas", $p->codigo_administrativo);
            $sheet->setCellValue("B$contadorCeldas", $p->codigo);
            $sheet->setCellValue("C$contadorCeldas", $p->nombre);
            $sheet->setCellValue("D$contadorCeldas", $p->autor);
            if($p->cuenta_id != null){
                $cuentaSelec = Cuenta::find($p->cuenta_id);
                $cuenta = $cuentaSelec->nombre;
            }else{
                $cuenta = '';
            }
            $sheet->setCellValue("E$contadorCeldas", $cuenta);
            $sheet->setCellValue("F$contadorCeldas", $p->sub_cuenta);

            $contadorCeldas++;
        }

        //definimos los estilos

        // fusionamos las celdas para el titulo
        $sheet->mergeCells("A1:F1");

        // estilo para el titulo principal
        $fuenteNegritaTitulo = array(
            'font'  => array(
                'bold'  => true,
                // 'color' => array('rgb' => 'FF0000'),
                'size'  => 14,
                'name'  => 'Verdana'
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        );

        $spreadsheet->getActiveSheet()->getStyle("A1")->applyFromArray($fuenteNegritaTitulo);

        // titulos encabezados en negrita
        $fuenteNegrita = array(
            'font'  => array(
                'bold'  => true,
                // 'color' => array('rgb' => 'FF0000'),
                'size'  => 10,
                'name'  => 'Verdana'
            ));

        $spreadsheet->getActiveSheet()->getStyle("A2:F2")->applyFromArray($fuenteNegrita);

        // ancho de las columnas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);

        // colocamos los bordes
        $bordeCeldas = --$contadorCeldas;
        $spreadsheet->getActiveSheet()->getStyle("A2:F$$bordeCeldas")->applyFromArray(
            array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => array('argb' => '000000')
                    )
                )
            )
        );

        
        // exportamos el excel
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
    }


    public function listadoDinamico(Request $request)
    {
        // extremos los datos para los combos de las busquedas
        $tecnicas = Tecnicamaterial::all();
        $ubicaciones = Ubicacion::all();
        $especialidades = Especialidad::all();
        $estilos = Estilo::all();

        $epocas = Patrimonio::select("epoca")
                            ->groupBy('epoca')
                            ->get();

        $autores = Patrimonio::select("autor")
                    ->groupBy("autor")
                    ->get();

        $patrimonios = Patrimonio::orderBy('id', 'desc')
                                ->limit(200)
                                ->get();

        $materiales =  Patrimonio::select('materiales')
                                ->whereNotNull('materiales')
                                ->groupBy('materiales')
                                ->get();

        $tecnicas =  Patrimonio::select('tecnicas')
                                ->whereNotNull('tecnicas')
                                ->groupBy('tecnicas')
                                ->get();

        return view('patrimonio.listadoDinamico')->with(compact('patrimonios', 'tecnicas', 'ubicaciones', 'especialidades', 'estilos', 'autores', 'epocas', 'materiales', 'tecnicas'));
    }

    public function ajaxListadoDinamico(Request $request)
    {
        // dd($request->all());

        $qPatrimonios = Patrimonio::query();    

        if($request->filled('codigo')){
            $codigo = $request->input('codigo');
            $qPatrimonios->where('codigo', 'like', "%$codigo");
        }

        if($request->filled('codigo_administrativo')){
            $codigo_administrativo = $request->input('codigo_administrativo');
            $qPatrimonios->where('codigo_administrativo', 'like', "$codigo_administrativo");
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

        if($request->filled('materiales')){
            $materiales = $request->input('materiales');
            $qPatrimonios->where('materiales', 'like',"%$materiales%");
        }

        if($request->filled('tecnicas')){
            $tecnicas = $request->input('tecnicas');
            $qPatrimonios->where('tecnicas', 'like',"%$tecnicas%");
        }

        // if($request->filled('tecnicamaterial_id')){
        //     $tecnica = $request->input('tecnicamaterial_id');
        //     $qPatrimonios->where('tecnicamaterial_id', "$tecnica");
        // }

        if($request->filled('epoca_busqueda')){
            $epoca = $request->input('epoca_busqueda');
            $qPatrimonios->where('epoca', "$epoca");
        }

        if(!$request->filled('codigo') && !$request->filled('nombre') && !$request->filled('autor_busqueda') && !$request->filled('especialidad_id') && !$request->filled('estilo_id') && !$request->filled('tecnicamaterial_id')){
            $qPatrimonios->orderBy('id', 'desc');
            $qPatrimonios->limit(200);
        }

        $patrimonios = $qPatrimonios->get();

        $tablaDinamica = array();

        if($request->filled('designacion_nombre_muestra')){
            array_push($tablaDinamica, 'designacion nombre');
        }

        if($request->filled('especialidad_muestra')){
            array_push($tablaDinamica, 'especialidad');
        }

        if($request->filled('estilo_muestra')){
            array_push($tablaDinamica, 'estilo');
        }

        if($request->filled('escuela_muestra')){
            array_push($tablaDinamica, 'escuela');
        }

        if($request->filled('epoca_muestra')){
            array_push($tablaDinamica, 'epoca');
        }

        if($request->filled('autor_muestra')){
            array_push($tablaDinamica, 'autor');
        }

        if($request->filled('tecnica_muestra')){
            array_push($tablaDinamica, 'tecnica');
        }

        if($request->filled('material_muestra')){
            array_push($tablaDinamica, 'material');
        }

        if($request->filled('codigo_muestra')){
            array_push($tablaDinamica, 'codigo');
        }

        if($request->filled('obtencion_muestra')){
            array_push($tablaDinamica, 'obtencion');
        }

        if($request->filled('fecha_adquisision_muestra')){
            array_push($tablaDinamica, 'fecha adquisicion');
        }

        if($request->filled('marcas_muestra')){
            array_push($tablaDinamica, 'marcas');
        }

        if($request->filled('descripcion_muestra')){
            array_push($tablaDinamica, 'descripcion');
        }

        if($request->filled('especificacion_muestra')){
            array_push($tablaDinamica, 'especificacion');
        }

        if($request->filled('intervencion_muestra')){
            array_push($tablaDinamica, 'intervencion');
        }

        if($request->filled('caracteristicas_tecnicas_muestra')){
            array_push($tablaDinamica, 'caracteristicas tecnicas');
        }

        if($request->filled('caracteristicas_iconograficas_muestra')){
            array_push($tablaDinamica, 'caracteristicas iconograficas');
        }

        if($request->filled('historicos_muestra')){
            array_push($tablaDinamica, 'historicos');
        }

        if($request->filled('bibliograficas_muestra')){
            array_push($tablaDinamica, 'bibliograficas');
        }

        if($request->filled('observaciones_muestra')){
            array_push($tablaDinamica, 'observaciones');
        }

        // dd($patrimonios);

        return view('patrimonio.ajaxListadoDinamico')->with(compact('patrimonios', 'tablaDinamica'));

    }

    public function generaExcelDinamico(Request $request){
        // dd($request->all());
        // buscamos los patrimonios
        $qPatrimonios = Patrimonio::query();    

        if($request->filled('codigo')){
            $codigo = $request->input('codigo');
            $qPatrimonios->where('codigo', 'like', "%$codigo");
        }

        if($request->filled('codigo_administrativo')){
            $codigo_administrativo = $request->input('codigo_administrativo');
            $qPatrimonios->where('codigo_administrativo', 'like', "$codigo_administrativo");
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

        if($request->filled('materiales')){
            $materiales = $request->input('materiales');
            $qPatrimonios->where('materiales', 'like',"%$materiales%");
        }

        if($request->filled('tecnicas')){
            $tecnicas = $request->input('tecnicas');
            $qPatrimonios->where('tecnicas', 'like',"%$tecnicas%");
        }

        // if($request->filled('tecnicamaterial_id')){
        //     $tecnica = $request->input('tecnicamaterial_id');
        //     $qPatrimonios->where('tecnicamaterial_id', "$tecnica");
        // }

        if($request->filled('epoca_busqueda')){
            $epoca = $request->input('epoca_busqueda');
            $qPatrimonios->where('epoca', "$epoca");
        }

        $patrimonios = $qPatrimonios->get();


        $tablaDinamica = array();

        if($request->filled('designacion_nombre_muestra')){
            array_push($tablaDinamica, 'designacion nombre');
        }

        if($request->filled('especialidad_muestra')){
            array_push($tablaDinamica, 'especialidad');
        }

        if($request->filled('estilo_muestra')){
            array_push($tablaDinamica, 'estilo');
        }

        if($request->filled('escuela_muestra')){
            array_push($tablaDinamica, 'escuela');
        }

        if($request->filled('epoca_muestra')){
            array_push($tablaDinamica, 'epoca');
        }

        if($request->filled('autor_muestra')){
            array_push($tablaDinamica, 'autor');
        }

        if($request->filled('tecnica_muestra')){
            array_push($tablaDinamica, 'tecnica');
        }

        if($request->filled('material_muestra')){
            array_push($tablaDinamica, 'material');
        }

        if($request->filled('codigo_muestra')){
            array_push($tablaDinamica, 'codigo');
        }

        if($request->filled('obtencion_muestra')){
            array_push($tablaDinamica, 'obtencion');
        }

        if($request->filled('fecha_adquisision_muestra')){
            array_push($tablaDinamica, 'fecha adquisicion');
        }

        if($request->filled('marcas_muestra')){
            array_push($tablaDinamica, 'marcas');
        }

        if($request->filled('descripcion_muestra')){
            array_push($tablaDinamica, 'descripcion');
        }

        if($request->filled('especificacion_muestra')){
            array_push($tablaDinamica, 'especificacion');
        }

        if($request->filled('intervencion_muestra')){
            array_push($tablaDinamica, 'intervencion');
        }

        if($request->filled('caracteristicas_tecnicas_muestra')){
            array_push($tablaDinamica, 'caracteristicas tecnicas');
        }

        if($request->filled('caracteristicas_iconograficas_muestra')){
            array_push($tablaDinamica, 'caracteristicas iconograficas');
        }

        if($request->filled('historicos_muestra')){
            array_push($tablaDinamica, 'historicos');
        }

        if($request->filled('bibliograficas_muestra')){
            array_push($tablaDinamica, 'bibliograficas');
        }

        if($request->filled('observaciones_muestra')){
            array_push($tablaDinamica, 'observaciones');
        }

        // generacion del excel
        $fileName = 'patrimonios.xlsx';
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle("certifica_cal");
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'LISTADO DE PATRIMONIOS');


        if(!empty($tablaDinamica)){
            $numeroletra = 65;

            foreach ($tablaDinamica as $tabDim){
                $sheet->setCellValue(chr($numeroletra).'2', strtoupper($tabDim));
                $numeroletra++;
            }

            $contadorCeldas = 3;
            $numeroletra = 65;
            $contador = 0;   
            $letra = chr($numeroletra);


            foreach ($patrimonios as $key => $p){

                if(in_array("designacion nombre", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->nombre);
                    $numeroletra++;
                }

                if(in_array("especialidad", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    if($p->especialidad_id != null){
                        $sheet->setCellValue("$letra"."$contadorCeldas", $p->especialidad->nombre);
                    }else{
                        $sheet->setCellValue("$letra"."$contadorCeldas", '');
                    }
                    $numeroletra++;
                }

                if(in_array("estilo", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    if($p->estilo_id != null){
                        $sheet->setCellValue("$letra"."$contadorCeldas", $p->estilo->nombre);
                    }else{
                        $sheet->setCellValue("$letra"."$contadorCeldas", '');
                    }
                    $numeroletra++;
                }

                if(in_array("escuela", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->escuela);
                    $numeroletra++;
                }

                if(in_array("epoca", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->epoca);
                    $numeroletra++;
                }

                if(in_array("autor", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->autor);
                    $numeroletra++;
                }

                if(in_array("tecnica", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->tecnicas);
                    $numeroletra++;
                }

                if(in_array("material", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->materiales);
                    $numeroletra++;
                }

                if(in_array("codigo", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->codigo);
                    $numeroletra++;
                }

                if(in_array("obtencion", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->obtencion);
                    $numeroletra++;
                }

                if(in_array("fecha adquisicion", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->fecha_adquisicion);
                    $numeroletra++;
                }

                if(in_array("marcas", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->marcas);
                    $numeroletra++;
                }

                if(in_array("descripcion", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->descripcion);
                    $numeroletra++;
                }

                if(in_array("especificacion", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->especificacion_conservacion);
                    $numeroletra++;
                }

                if(in_array("intervenciones", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->intervenciones_realizadas);
                    $numeroletra++;
                }

                if(in_array("caracteristicas tecnicas", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->caracteristicas_tecnicas);
                    $numeroletra++;
                }

                if(in_array("caracteristicas iconograficas", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->caracteristicas_iconograficas);
                    $numeroletra++;
                }

                if(in_array("historicos", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->historicos);
                    $numeroletra++;
                }

                if(in_array("bibliograficas", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->bibliograficas);
                    $numeroletra++;
                }

                if(in_array("observaciones", $tablaDinamica)){
                    $letra = chr($numeroletra);
                    $sheet->setCellValue("$letra"."$contadorCeldas", $p->observaciones);
                    $numeroletra++;
                }

                $numeroletra = 65;
                $contadorCeldas++;
            }

            //definimos los estilos

            // fusionamos las celdas para el titulo
            // dd(count($tablaDinamica));
            $fun = 64 + count($tablaDinamica);
            $sheet->mergeCells("A1:".chr($fun)."1");

            // titulos encabezados en negrita
            $fuenteNegrita = array(
                'font'  => array(
                    'bold'  => true,
                    // 'color' => array('rgb' => 'FF0000'),
                    'size'  => 10,
                    'name'  => 'Verdana'
                ));

            $spreadsheet->getActiveSheet()->getStyle("A2:".chr($fun)."2")->applyFromArray($fuenteNegrita);

            // ancho de las columnas
            $letraIni = 65;

            for($i = 0; $i < count($tablaDinamica) ; $i++ ){
                $spreadsheet->getActiveSheet()->getColumnDimension(chr($letraIni))->setWidth(30);
                $letraIni++;
            }

            // colocamos los bordes
            $bordeCeldas = --$contadorCeldas;
            $spreadsheet->getActiveSheet()->getStyle("A2:".chr($fun).$bordeCeldas)->applyFromArray(
                array(
                    'borders' => array(
                        'allBorders' => array(
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => array('argb' => '000000')
                        )
                    )
                )
            );

        }else{
            //colocamos los valores en el excel

            $sheet->setCellValue('A2', 'CODIGO ADM');
            $sheet->setCellValue('B2', 'CODIGO');
            $sheet->setCellValue('C2', 'TITULO');
            $sheet->setCellValue('D2', 'AUTOR');
            $sheet->setCellValue('E2', 'EPOCA');
            $sheet->setCellValue('F2', 'ESPECIALIDAD');
            $sheet->setCellValue('G2', 'ESTILO');
            $sheet->setCellValue('H2', 'TECNICAS');
            $sheet->setCellValue('I2', 'MATERIALES');

            $contadorCeldas = 3;
            foreach ($patrimonios as $key => $p) {

                $sheet->setCellValue("A$contadorCeldas", $p->codigo_administrativo);
                $sheet->setCellValue("B$contadorCeldas", $p->codigo);
                $sheet->setCellValue("C$contadorCeldas", $p->nombre);
                $sheet->setCellValue("D$contadorCeldas", $p->autor);
                $sheet->setCellValue("E$contadorCeldas", $p->epoca);
                $sheet->setCellValue("F$contadorCeldas", ($p->especialidad_id != null)?$p->especialidad->nombre:'');
                $sheet->setCellValue("G$contadorCeldas", ($p->estilo_id != null)?$p->estilo->nombre:'');
                $sheet->setCellValue("H$contadorCeldas", ($p->tecnicamaterial_id != null)?$p->tecnicas:'');
                $sheet->setCellValue("I$contadorCeldas", ($p->tecnicamaterial_id != null)?$p->materiales:'');


                $contadorCeldas++;
            }

            //definimos los estilos

            // fusionamos las celdas para el titulo
            $sheet->mergeCells("A1:I1");


            // titulos encabezados en negrita
            $fuenteNegrita = array(
                'font'  => array(
                    'bold'  => true,
                    // 'color' => array('rgb' => 'FF0000'),
                    'size'  => 10,
                    'name'  => 'Verdana'
                ));

            $spreadsheet->getActiveSheet()->getStyle("A2:I2")->applyFromArray($fuenteNegrita);

            // ancho de las columnas
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(30);

            // colocamos los bordes
            $bordeCeldas = --$contadorCeldas;
            $spreadsheet->getActiveSheet()->getStyle("A2:I$$bordeCeldas")->applyFromArray(
                array(
                    'borders' => array(
                        'allBorders' => array(
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => array('argb' => '000000')
                        )
                    )
                )
            );
        }

        // estilo para el titulo principal
        $fuenteNegritaTitulo = array(
            'font'  => array(
                'bold'  => true,
                // 'color' => array('rgb' => 'FF0000'),
                'size'  => 14,
                'name'  => 'Verdana'
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        );

        $spreadsheet->getActiveSheet()->getStyle("A1")->applyFromArray($fuenteNegritaTitulo);




        // exportamos el excel
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
    }

}