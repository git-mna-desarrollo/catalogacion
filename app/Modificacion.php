<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modificacion extends Model
{
    protected $table = "modificaciones";
    
    protected $fillable = [
        'user_id', 
        'patrimonio_id', 
        'campo',
        'dato_anteriror', 
        'dato_modificado', 
        'action', 
        'estado',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function patrimonio()
    {
        return $this->belongsTo('App\Patrimonio', 'patrimonio_id');
    }
}
