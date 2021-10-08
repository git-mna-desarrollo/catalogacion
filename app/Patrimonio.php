<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patrimonio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'creador_id', 
        'modificador_id', 
        'eliminador_id', 
        'localidad_id', 
        'departamento_id', 
        'provincia_id', 
        'ubicacion_id', 
        'tecnicamaterial_id', 
        'direccion', 
        'nombre', 
        'especialidad', 
        'estilo', 
        'escuela', 
        'epoca', 
        'autor', 
        'inventario', 
        'codigo', 
        'inventario_anterior',
        'origen', 
        'obtencion', 
        'fecha_adquisicion', 
        'marcas', 
        'dimenciones', 
        'descripcion', 
        'archivo_fotografico', 
        'estado_conservacion', 
        'intervenciones_realizadas', 
        'caracteristicas_tecnicas', 
        'caracteristicas_iconograficas', 
        'datos_historicos', 
        'referencias_bibliograficas', 
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

    public function localidad()
    {
        return $this->belongsTo('App\Localidad', 'localidad_id');
    }

    public function departamento()
    {
        return $this->belongsTo('App\Departamento', 'departamento_id');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Departamento', 'provincia_id');
    }

    public function ubicacion()
    {
        return $this->belongsTo('App\Ubicacion', 'ubicacion_id');
    }

    public function tecnicamaterial()
    {
        return $this->belongsTo('App\Tecnicamaterial', 'tecnicamaterial_id');
    }
}