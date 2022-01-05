<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tecnica extends Model
{
    use SoftDeletes;
    protected $table = "tecnicas";

    protected $fillable = [
        'creador_id', 
        'modificador_id', 
        'eliminador_id', 
        'nombre', 
        'descripcion', 
        'estado',
        'deleted_at'
    ];
}
