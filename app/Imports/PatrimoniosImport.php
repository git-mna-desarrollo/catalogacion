<?php

namespace App\Imports;

use App\Estilo;
use App\Ubicacion;
use App\Patrimonio;
use App\Especialidad;
use App\Tecnicamaterial;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PatrimoniosImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        echo "Codigo ".$row[14]." - Nombre ".$row[7]."<br />";

        // buscamos la ubicacion
        $buscaUbicacion = Ubicacion::where('nombre', 'like', "%$row[5]%")
                                    ->first();

        // dd($buscaUbicacion);
        // $ubicacionSinEspacios = Str::of($row[5])->trim();
        // $ubicacionMayusculas = Str::of($ubicacionSinEspacios)->upper();                                    
        // preguntamos si exisite                  
        if($buscaUbicacion == null)
        {
            // $ubicacion = new Ubicacion();
            // $ubicacion->creador_id = 1;
            // $ubicacion->nombre = $row[5];
            // $ubicacion->save();

            $ubicacionId = null;

        }else{
            $ubicacionId = $buscaUbicacion->id;
        }

        // dd($ubicacionId);

        // buscamos la especialidad
        $buscaEspecialidad = Especialidad::where('nombre', 'like', "%$row[8]%")
                                    ->first();

        // $especialidadSinEspacios = Str::of($row[8])->trim();
        // $especialidadMayusculas = Str::of($especialidadSinEspacios)->upper();                                    

        // preguntamos si exisite                  
        if($buscaEspecialidad == null)
        {
            // $especialidad = new Especialidad();
            // $especialidad->creador_id = 1;
            // $especialidad->nombre = $row[8];
            // $especialidad->save();

            $especialidadId = null;

        }else{
            $especialidadId = $buscaEspecialidad->id;
        }

        // buscamos la estilo
        $buscaEstilo = Estilo::where('nombre', 'like', "%$row[9]%")
                                    ->first();

        // dd($buscaEstilo);
        // $estiloSinEspacios = Str::of($row[9])->trim();
        // $estiloMayusculas = Str::of($estiloSinEspacios)->upper();                                    

        // preguntamos si exisite                  
        if($buscaEstilo == null)
        {
            // $estilo = new Estilo();
            // $estilo->creador_id = 1;
            // $estilo->nombre = $row[9];
            // $estilo->save();

            $estiloId = null;

        }else{
            $estiloId = $buscaEstilo->id;
        }

        // dd($estiloId);

        // buscamos la tecnica y material
        $buscaMaterial = Tecnicamaterial::where('nombre', 'like', "%$row[13]%")
                                    ->first();

        // $materialSinEspacios = Str::of($row[13])->trim();
        // $materialMayusculas = Str::of($materialSinEspacios)->upper();                                    

        // preguntamos si exisite                  
        if($buscaMaterial == null)
        {
            // $tm = new Tecnicamaterial();
            // $tm->creador_id = 1;
            // $tm->nombre = $row[13];
            // $tm->save();

            $tmId = null;

        }else{
            $tmId = $buscaMaterial->id;
        }



        $patrimonio                      = new Patrimonio();
        // $patrimonio->creador_id          = 1;
        // $patrimonio->responsable_id      = 1;
        $patrimonio->ubicacion_id        = $ubicacionId;
        $patrimonio->especialidad_id     = $especialidadId;
        $patrimonio->estilo_id           = $estiloId;
        $patrimonio->tecnicamaterial_id  = $tmId;
        $patrimonio->localidad           = "CIUDAD DE LA PAZ";
        $patrimonio->provincia           = "MURILLO";
        $patrimonio->departamento        = "LA PAZ";
        $patrimonio->inmueble            = "MUSEO NACIONAL DE ARTE";
        $patrimonio->calle               = $row[4];
        $patrimonio->nombre              = $row[7];
        $patrimonio->escuela             = $row[10];
        $patrimonio->epoca               = $row[11];
        $patrimonio->autor               = $row[12];
        $patrimonio->inventario          = $row[14];
        $patrimonio->codigo              = $row[15];
        $patrimonio->inventario_anterior = $row[16];
        $patrimonio->origen              = $row[17];
        $patrimonio->obtencion           = $row[18];
        $patrimonio->fecha_adquisicion   = $row[19];
        $patrimonio->marcas              = $row[20];
        $patrimonio->descripcion         = $row[29];
        $patrimonio->archivo_fotografico = $row[30];
        $patrimonio->save();


    }

    public function startRow(): int
    {
        return 2;
    }
}
