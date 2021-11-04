<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dimencion extends Model
{
    use SoftDeletes;
    protected $table = "dimenciones";

    protected $fillable = [
        'creador_id', 
        'modificador_id', 
        'eliminador_id', 
        'nombre', 
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
