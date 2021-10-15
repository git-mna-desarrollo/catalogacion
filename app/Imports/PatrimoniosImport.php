<?php

namespace App\Imports;

use App\Patrimonio;
use Maatwebsite\Excel\Concerns\ToModel;

class PatrimoniosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        echo "Ciudad ".$row[0]." - Nombre ".$row[7]."<br />";

        $buscaUbicacion = Ubicacion::where('nombre', 'like', "%$row[5]%")
                                    ->count();

        if($buscaUbicacion == 0)
        {
            $ubicacion = new Ubicacion();
            $ubicacion->creador_id = 1;
            $ubicacion->creador_id = 1;
        }

        $patrimonio = new Patrimonio();
        $patrimonio->creador_id = 1;
        // $patrimonio->creador_id = 1;
    }
}
