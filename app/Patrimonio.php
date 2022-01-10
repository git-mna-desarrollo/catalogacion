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
        'ubicacion_id', 
        'especialidad_id', 
        'estilo_id', 
        'cuenta_id',
        'tecnicamaterial_id', 
        'direccion', 
        'nombre', 
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
        'valor', 
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

    public function ubicacion()
    {
        return $this->belongsTo('App\Ubicacion', 'ubicacion_id');
    }

    public function tecnicamaterial()
    {
        return $this->belongsTo('App\Tecnicamaterial', 'tecnicamaterial_id');
    }

    public function especialidad()
    {
        return $this->belongsTo('App\Especialidad', 'especialidad_id');
    }

    public function estilo()
    {
        return $this->belongsTo('App\Estilo', 'estilo_id');
    }

    public function cuenta()
    {
        return $this->belongsTo('App\Cuenta', 'cuenta_id');
    }
}