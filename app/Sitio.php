<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sitio extends Model
{
    use SoftDeletes;
    // protected $table = "estilos";

    protected $fillable = [
        'creador_id', 
        'modificador_id', 
        'eliminador_id', 
        'sigla', 
        'descripcion', 
        'estado',
        'deleted_at'
    ];

    public function creador()
    {
        return $this->belongsTo('App\User', 'creador_id');
    }

    public function modificador()
    {
        return $this->belongsTo('App\User', 'modificador_id');
    }

    public function eliminador()
    {
        return $this->belongsTo('App\User', 'eliminador_id');
    }

}
