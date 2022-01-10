<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Version extends Model
{
    use SoftDeletes;
    protected $table = "versiones";

    protected $fillable = [
        'creador_id',
        'modificador_id',
        'eliminador_id',
        'patrimonio_id',
        'patrimonio',
        'estado',
        'deleted_at',
    ];
}
