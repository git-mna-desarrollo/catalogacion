<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revision extends Model
{
    use SoftDeletes;
    protected $table = "revisiones";

    protected $fillable = [
        'creador_id', 
        'modificador_id', 
        'eliminador_id', 
        'patrimonio_id', 
        'estado',
        'terminado',
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

}
