<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubEspecialidad extends Model
{
    use SoftDeletes;
    protected $table = "subespecialidades";

    protected $fillable = [
        'creador_id', 
        'modificador_id', 
        'eliminador_id', 
        'especialidad_id', 
        'nombre', 
        'descripcion', 
        'estado',
        'deleted_at'
    ];
}
