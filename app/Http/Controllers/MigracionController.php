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
}
