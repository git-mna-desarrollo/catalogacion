<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MigracionController extends Controller
{
    public function patrimonios()
    {
        $archivo = public_path("c.xlsx");
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo);
        // dd($spreadsheet);
        // $schdeules = $spreadsheet->getActiveSheet()->toArray();
        $d=$spreadsheet->getSheet(0)->toArray();
        // dd($d);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $i=1;
        unset($sheetData[0]);

        foreach ($sheetData as $t) {
        // process element here;

            echo $i."---".$t[0].",".$t[1]." <br>";
            $i++;
        }
        
       
    }
}
