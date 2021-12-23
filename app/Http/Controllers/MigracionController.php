<?php

namespace App\Http\Controllers;

use App\Estado;

use App\Estilo;
use App\Dimencion;
use App\Ubicacion;
use App\Patrimonio;
use App\Especialidad;
use App\Tecnicamaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MigracionController extends Controller
{
    public function patrimonios()
    {
        $archivo = public_path("c.xlsx");
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo);

        $d=$spreadsheet->getSheet(0)->toArray();

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $i=1;

        unset($sheetData[0]);

        foreach ($sheetData as $row) {
            // process element here;

                // echo $i."---".$t[0].",".$t[1]." <br>";

            echo "Fila: ".$i." - Especialidad ".$row[8]." - Codigo ".$row[14]." - Nombre ".$row[7]."<br />";

            // $patrimonioId = null;

            // buscamos la ubicacion
            $buscaUbicacion = Ubicacion::where('nombre', 'like', "%$row[5]%")
                                        ->first();

            // preguntamos si exisite                  
            if($buscaUbicacion == null)
            {
                $ubicacionId = null;

            }else{
                $ubicacionId = $buscaUbicacion->id;
            }

            // buscamos la especialidad
            $buscaEspecialidad = Especialidad::where('nombre', 'like', "%$row[8]%") 
                                        ->first();

            // preguntamos si exisite                  
            if($buscaEspecialidad == null)
            {
                $especialidadId = null;

            }else{
                $especialidadId = $buscaEspecialidad->id;
            }

            // buscamos la estilo
            $buscaEstilo = Estilo::where('nombre', 'like', "%$row[9]%")
                                        ->first();

            // preguntamos si exisite                  
            if($buscaEstilo == null)
            {
                $estiloId = null;

            }else{
                $estiloId = $buscaEstilo->id;
            }

            // buscamos la tecnica y material
            $buscaMaterial = Tecnicamaterial::where('nombre', 'like', "%$row[13]%")
                                        ->first();

            // preguntamos si exisite                  
            if($buscaMaterial == null)
            {
                $tmId = null;

            }else{
                $tmId = $buscaMaterial->id;
            }

            $patrimonio                          = new Patrimonio();
            $patrimonio->creador_id              = 1;
            $patrimonio->responsable_id          = 1;
            $patrimonio->ubicacion_id            = $ubicacionId;
            $patrimonio->especialidad_id         = $especialidadId;
            $patrimonio->estilo_id               = $estiloId;
            $patrimonio->tecnicamaterial_id      = $tmId;
            $patrimonio->localidad               = "CIUDAD DE LA PAZ";
            $patrimonio->provincia               = "MURILLO";
            $patrimonio->departamento            = "LA PAZ";
            $patrimonio->inmueble                = "MUSEO NACIONAL DE ARTE";
            $patrimonio->calle                   = "COMERCIO ESQ. SOCABAYA";
            $patrimonio->nombre                  = $row[7];
            $patrimonio->escuela                 = $row[10];
            $patrimonio->epoca                   = $row[11];
            $patrimonio->autor                   = $row[12];
            $patrimonio->inventario              = $row[14];
            $patrimonio->codigo                  = $row[15];
            $patrimonio->inventario_anterior     = $row[16];
            $patrimonio->origen                  = $row[17];
            $patrimonio->obtencion               = $row[18];
            $patrimonio->fecha_adquisicion_texto = $row[19];
            $patrimonio->marcas                  = $row[20];
            $patrimonio->descripcion             = $row[29];
            $patrimonio->rollo                   = 1;
            $patrimonio->fotografo               = $row[32];
            $patrimonio->fecha_fotografia        = $row[33];
            $patrimonio->toma                    = $row[34];
            $patrimonio->alto                    = $row[22];
            $patrimonio->ancho                   = $row[23];
            $patrimonio->diametro                = $row[24];
            $patrimonio->circunferencia          = $row[25];
            $patrimonio->largo                   = $row[26];
            $patrimonio->profundidad             = $row[27];
            $patrimonio->peso                    = $row[28];

            $patrimonio->especificacion_conservacion   = $row[53];
            $patrimonio->intervenciones_realizadas     = $row[54];
            $patrimonio->caracteristicas_tecnicas      = $row[55];
            $patrimonio->caracteristicas_iconograficas = $row[56];
            $patrimonio->datos_historicos              = $row[57];
            $patrimonio->referencias_bibliograficas    = $row[58];
            
            $patrimonio->observaciones  = $row[59];
            $patrimonio->catalogo       = $row[62];
            $patrimonio->fecha_catalogo = $row[63];
            $patrimonio->elaboro        = $row[64];
            $patrimonio->fecha_elaboro  = $row[65];
            $patrimonio->reviso         = $row[66];
            $patrimonio->fecha_reviso   = $row[67];

            $patrimonio->save();

            $patrimonioId = $patrimonio->id;

                         // preguntamos si es monumento nacional
            if($row[36] != ''){
                $monNac = 'Si';
            }else{
                $monNac = 'No';
            }

            // preguntamos si es resolucion municipal
            if($row[37] != ''){
                $resolMun = 'Si';
            }else{
                $resolMun = 'No';
            }

            // preguntamos si es resolucion administrativa
            if($row[38] != ''){
                $resolAdm = 'Si';
            }else{
                $resolAdm = 'No';
            }

            // preguntamos si es individual
            if($row[39] != ''){
                $individual = 'Si';
            }else{
                $individual = 'No';
            }

            // preguntamos si es conjunto
            if($row[40] != ''){
                $conjunto = 'Si';
            }else{
                $conjunto = 'No';
            }

            // preguntamos si es ninguna
            if($row[39] != ''){
                $ninguna = 'Si';
            }else{
                $ninguna = 'No';
            }

            $estadoConservacion = null;
            // preguntamos el estado de conservacion
            if($row[43] != ''){
                $estadoConservacion = 'Excelente';
            }elseif($row[44] != ''){
                $estadoConservacion = 'Malo';
            }elseif($row[45] != ''){
                $estadoConservacion = 'Bueno';
            }elseif($row[46] != ''){
                $estadoConservacion = 'Pesimo';
            }elseif($row[47] != ''){
                $estadoConservacion = 'Regular';
            }elseif($row[48] != ''){
                $estadoConservacion = 'Fragmento';
            }

            $condicionesSeguridad = null;
            // preguntamos las condiciones de seguridad
            if($row[50] != ''){
                $condicionesSeguridad = 'Buena';
            }elseif($row[51] != ''){
                $condicionesSeguridad = 'Razonable';
            }elseif($row[52] != ''){
                $condicionesSeguridad = 'Ninguna';
            }

            $estado                            = new Estado();
            $estado->patrimonio_id             = $patrimonioId;
            $estado->monumento_nacional        = $monNac;
            $estado->resolucion_municipal      = $resolMun;
            $estado->resolucion_administrativa = $resolAdm;
            $estado->individual                = $individual;
            $estado->conjunto                  = $conjunto;
            $estado->ninguna                   = $ninguna;
            $estado->estado_conservacion       = $estadoConservacion;
            $estado->condiciones_seguridad     = $condicionesSeguridad;
            $estado->save();       
           
            $i++;
        }
        
    }

    public function regularizaEstados() {

        $archivo = public_path("c.xlsx");
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo);

        $d=$spreadsheet->getSheet(0)->toArray();

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $i=1;

        // descartamos la primera fila del excel
        unset($sheetData[0]);

        foreach ($sheetData as $row) {

            $patrimonio = Patrimonio::where('codigo', "$row[15]")
                            ->first();

            if($patrimonio != null) {
                $patrimonioId = $patrimonio->id;
            }
            
            echo "Fila: ".$i." - Especialidad ".$row[8]." - Codigo ".$row[14]." - Nombre ".$row[7]."<br />";
             // preguntamos si es monumento nacional
            if($row[36] != ''){
                $monNac = 'Si';
            }else{
                $monNac = 'No';
            }

            // preguntamos si es resolucion municipal
            if($row[37] != ''){
                $resolMun = 'Si';
            }else{
                $resolMun = 'No';
            }

            // preguntamos si es resolucion administrativa
            if($row[38] != ''){
                $resolAdm = 'Si';
            }else{
                $resolAdm = 'No';
            }

            // preguntamos si es individual
            if($row[39] != ''){
                $individual = 'Si';
            }else{
                $individual = 'No';
            }

            // preguntamos si es conjunto
            if($row[40] != ''){
                $conjunto = 'Si';
            }else{
                $conjunto = 'No';
            }

            // preguntamos si es ninguna
            if($row[39] != ''){
                $ninguna = 'Si';
            }else{
                $ninguna = 'No';
            }

            $estadoConservacion = null;
            // preguntamos el estado de conservacion
            if($row[43] != ''){
                $estadoConservacion = 'Excelente';
            }elseif($row[44] != ''){
                $estadoConservacion = 'Malo';
            }elseif($row[45] != ''){
                $estadoConservacion = 'Bueno';
            }elseif($row[46] != ''){
                $estadoConservacion = 'Pesimo';
            }elseif($row[47] != ''){
                $estadoConservacion = 'Regular';
            }elseif($row[48] != ''){
                $estadoConservacion = 'Fragmento';
            }

            $condicionesSeguridad = null;
            // preguntamos las condiciones de seguridad
            if($row[50] != ''){
                $condicionesSeguridad = 'Buena';
            }elseif($row[51] != ''){
                $condicionesSeguridad = 'Razonable';
            }elseif($row[52] != ''){
                $condicionesSeguridad = 'Ninguna';
            }

            if($patrimonio != null) {
                $estado                            = new Estado();
                $estado->patrimonio_id             = $patrimonioId;
                $estado->monumento_nacional        = $monNac;
                $estado->resolucion_municipal      = $resolMun;
                $estado->resolucion_administrativa = $resolAdm;
                $estado->individual                = $individual;
                $estado->conjunto                  = $conjunto;
                $estado->ninguna                   = $ninguna;
                $estado->estado_conservacion       = $estadoConservacion;
                $estado->condiciones_seguridad     = $condicionesSeguridad;
                $estado->save();       
            }

            $i++;
        }

    }

    public function tecnicaMaterial(Request $request)
    {
        $archivo = public_path("tecnica.xlsx");
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo);
        $d=$spreadsheet->getSheet(0)->toArray();

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $i=1;

        // descartamos la primera fila del excel
        unset($sheetData[0]);

        foreach ($sheetData as $row) {

            $tecnica = Tecnicamaterial::where('nombre', 'like', "%$row[0]%")
                                        ->first();

            if($tecnica){
                echo "<font color='red'>".$row[0]."- SI </font><br />";
            }else{
                echo $row[0]."- NO <br />";
                $tecnica = new Tecnicamaterial();
                $tecnica->creador_id = 1;
                $tecnica->nombre = $row[0];
                $tecnica->save();
            }
        }
    }

    public function gilimana(Request $request) 
    {
        $archivo = public_path("gilimana.xlsx");
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo);
        $d=$spreadsheet->getSheet(0)->toArray();

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $i=1;

        // descartamos la primera fila del excel
        unset($sheetData[0]);

        foreach ($sheetData as $row) {

            // buscamos la especialidad
            $buscaEspecialidad = Especialidad::where('nombre', 'like', "%$row[11]%") 
                                        ->first();

            // preguntamos si exisite                  
            if($buscaEspecialidad == null)
            {
                $especialidadId = null;

            }else{
                $especialidadId = $buscaEspecialidad->id;
            }

            // buscamos la tecnica y material
            $buscaMaterial = Tecnicamaterial::where('nombre', 'like', "%$row[8]%")
                                        ->first();

            // preguntamos si exisite                  
            if($buscaMaterial == null)
            {
                $tmId = null;

            }else{
                $tmId = $buscaMaterial->id;
            }

            // $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
            // $fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]));

            echo "Fila -".$row[0]."codigo ".$row[0]."----".$row[2]." Fecha --".$row[5]."<br />";

            $patrimonio                        = new Patrimonio();
            $patrimonio->creador_id            = 1;
            $patrimonio->responsable_id        = 1;
            $patrimonio->ubicacion_id          = 37;
            $patrimonio->especialidad_id       = $especialidadId;
            $patrimonio->tecnicamaterial_id    = $tmId;
            $patrimonio->localidad             = "CIUDAD DE LA PAZ";
            $patrimonio->provincia             = "MURILLO";
            $patrimonio->departamento          = "LA PAZ";
            $patrimonio->inmueble              = "EDIFICIO MANANTIAL";
            $patrimonio->calle                 = "CALLE 20 DE OCTUBRE";
            $patrimonio->nombre                = $row[9];
            $patrimonio->autor                 = $row[7];
            $patrimonio->codigo                = $row[2];
            $patrimonio->codigo_administrativo = $row[3];
            $patrimonio->forma_adquisicion     = $row[4];
            // $patrimonio->fecha_ingreso_adm     = $row[5];
            $patrimonio->valor                 = $row[6];
            $patrimonio->save();


            /*$tecnica = Tecnicamaterial::where('nombre', 'like', "%$row[0]%")
                                        ->first();

            if($tecnica){
                echo "<font color='red'>".$row[0]."- SI </font><br />";
            }else{
                echo $row[0]."- NO <br />";
                $tecnica = new Tecnicamaterial();
                $tecnica->creador_id = 1;
                $tecnica->nombre = $row[0];
                $tecnica->save();
            }*/
        }
    }

    // esta funcion regulariza los datos administrativos
    // hacia los patrimonios del MNA
    public function regularizacionAdminMna(Request $request)
    {
        $archivo = public_path("complemento_MNA.xlsx");
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo);
        $d=$spreadsheet->getSheet(0)->toArray();

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $i=1;

        // descartamos la primera fila del excel
        unset($sheetData[0]);
        $contador = 1;
        foreach ($sheetData as $row) {

            $patrimonio = Patrimonio::where('codigo', $row[2])
                                    ->whereNull('codigo_administrativo')
                                    ->first();

            if($patrimonio){
                echo $contador."<b> Codigo Inventario </b> ".$row[2]." <b>del MNA</b> ".$patrimonio->codigo." <b>Autor </b>".$patrimonio->autor."<br />";

                $regularizaPatrimonio                        = Patrimonio::find($patrimonio->id);
                $regularizaPatrimonio->codigo_administrativo = $row[1];
                $regularizaPatrimonio->valor                 = $row[5];
                $regularizaPatrimonio->cuenta                = $row[13];
                $regularizaPatrimonio->sub_cuenta            = $row[14];
                $regularizaPatrimonio->save();

            }

            $contador++;           
                                    
        }

    }
}