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
        // preguntamos si es monumento nacional
        if($row[36] != ''){
            $mon = 'Es';
        }else{
            $mon = 'No';
        }

        echo "Monumento ".$mon." - Codigo ".$row[14]." - Nombre ".$row[7]."<br />";

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

        $patrimonio                      = new Patrimonio();
        $patrimonio->creador_id          = 1;
        $patrimonio->responsable_id      = 1;
        $patrimonio->ubicacion_id        = $ubicacionId;
        $patrimonio->especialidad_id     = $especialidadId;
        $patrimonio->estilo_id           = $estiloId;
        $patrimonio->tecnicamaterial_id  = $tmId;
        $patrimonio->localidad           = "CIUDAD DE LA PAZ";
        $patrimonio->provincia           = "MURILLO";
        $patrimonio->departamento        = "LA PAZ";
        $patrimonio->inmueble            = "MUSEO NACIONAL DE ARTE";
        $patrimonio->calle               = "COMERCIO ESQ. SOCABAYA";
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
        $patrimonioId = $patrimonio->id;

        



    }

    public function startRow(): int
    {
        return 2;
    }
}
