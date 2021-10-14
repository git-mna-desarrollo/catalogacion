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
    }
}
