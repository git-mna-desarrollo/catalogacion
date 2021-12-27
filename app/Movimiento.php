<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimiento extends Model
{
    use SoftDeletes;
    // protected $table = "dimenciones";

    protected $fillable = [
        'creador_id', 
        'modificador_id', 
        'eliminador_id', 
        'patrimonio_id', 
        'asignado_id',
        'destino_id',
        'sitio_id',
        'observaciones', 
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

    public function patrimonio()
    {
        return $this->belongsTo('App\Patrimonio', 'patrimonio_id');
    }

    public function asignado()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function destino()
    {
        return $this->belongsTo('App\Destino', 'ubicacion_id');
    }

    public function sitio()
    {
        return $this->belongsTo('App\Sitio', 'sitio_id');
    }
}