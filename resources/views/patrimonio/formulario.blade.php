@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    {{-- <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('assets/plugins/custom/uppy/uppy.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">NUEVO PATRIMONIO</h3>
                
            </div>
            <!--begin::Form-->
            <form action="{{ url('patrimonio/guarda') }}" method="POST" id="formularioPersona" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="example-preview">
                        <ul class="nav nav-pills nav-justified" id="myTab1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab-1" data-toggle="tab" href="#ubicacion">
                                    <span class="nav-icon">
                                        <i class="fas fa-map-marked"></i>
                                    </span>
                                    <span class="nav-text">UBICACION</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab-1" data-toggle="tab" href="#identificacion" aria-controls="profile">
                                    <span class="nav-icon">
                                        <i class="fas fa-file-signature"></i>
                                    </span>
                                    <span class="nav-text">IDENTIFICACION</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab-1" data-toggle="tab" href="#analisis" aria-controls="contact">
                                    <span class="nav-icon">
                                        <i class="fas fa-poll-h"></i>
                                    </span>
                                    <span class="nav-text">ANALISIS</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab-1" data-toggle="tab" href="#archivos" aria-controls="contact">
                                    <span class="nav-icon">
                                        <i class="fas fa-file-image"></i>
                                    </span>
                                    <span class="nav-text">IMAGENES</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab-1" data-toggle="tab" href="#documentos" aria-controls="contact">
                                    <span class="nav-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </span>
                                    <span class="nav-text">DOCUMENTOS</span>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content mt-5" id="myTabContent1">
                            <div class="tab-pane fade show active" id="ubicacion" role="tabpanel" aria-labelledby="home-tab-1">

                                {{-- ubicacion --}}
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">LOCALIDAD </label>
                                                <input type="text" class="form-control" id="localidad" name="localidad" value="CIUDAD DE LA PAZ" readonly />
                                                <input type="hidden" name="patrimonio_id" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->id:'' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">PROVINCIA </label>
                                                <input type="text" class="form-control" id="provincia" name="provincia" value="MURILLO" readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">DEPARTAMENTO </label>
                                                <input type="text" class="form-control" id="departamento" name="departamento" value="LA PAZ" readonly />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">INMUEBLE </label>
                                            <input type="text" class="form-control" id="inmueble" name="inmueble" value="MUSEO NACIONAL DE ARTE" readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">CALLE </label>
                                            <input type="text" class="form-control" id="calle" name="calle" value="CALLE COMERCIO ESQ. SOCABAYA" readonly />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">UBICACION
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" id="ubicacion_id" name="ubicacion_id" style="width: 100%">
                                                @forelse ($ubicaciones as $u)
                                                @php
                                                    if($datosPatrimonio != null && $datosPatrimonio->ubicacion_id==$u->id){
                                                        $seleccionado = 'selected';
                                                    }else{
                                                        $seleccionado = '';
                                                    }
                                                @endphp
                                                <option value="{{ $u->id }}" {{ $seleccionado }}>{{ $u->nombre }}</option>
                                                @empty
                                    
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                {{-- fin ubicacion --}}
                            </div>
                            <div class="tab-pane fade" id="identificacion" role="tabpanel" aria-labelledby="profile-tab-1">

                                {{-- IDENTIFICACION --}}                       
                                
                                <div class="row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ALTO
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="alto" name="alto" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->alto:'' }}" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ANCHO
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="ancho" name="ancho" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->ancho:'' }}" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">DIAMETRO
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="diametro" name="diametro" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->diametro:'' }}" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">CIRCUNFERENCIA
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="circunferencia" name="circunferencia" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->circunferencia:'' }}" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">LARGO
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="largo" name="largo" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->largo:'' }}" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">PROFUNDIDAD
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="profundidad" name="profundidad" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->profundidad:'' }}" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">PESO 
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="peso" name="peso" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->peso:'' }}" />
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">DESIGNACION/NOMBRE
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->nombre:'' }}" required />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ESPECIALIDAD
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" id="especialidad_id" name="especialidad_id" style="width: 100%">
                                                @forelse ($especialidades as $e)
                                                @php
                                                    if($datosPatrimonio != null && $datosPatrimonio->especialidad_id==$e->id){
                                                        $seleccionado = 'selected';
                                                    }else{
                                                        $seleccionado = '';
                                                    }
                                                @endphp

                                                <option value="{{ $e->id }}" {{ $seleccionado }}>{{ $e->nombre }}</option>
                                                @empty
                                    
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ESTILO
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" id="estilo_id" name="estilo_id" style="width: 100%">
                                                @forelse ($estilos as $es)

                                                @php
                                                    if($datosPatrimonio != null && $datosPatrimonio->estilo_id==$es->id){
                                                        $seleccionado = 'selected';
                                                    }else{
                                                        $seleccionado = '';
                                                    }
                                                @endphp

                                                <option value="{{ $es->id }}" {{ $seleccionado }}>{{ $es->nombre }}</option>
                                                @empty
                                    
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Escuela
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="escuela" name="escuela" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->escuela:'' }}" />
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Epoca y/o Fecha
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="epoca" name="epoca" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->epoca:'' }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Autor/Atribucion
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="autor" name="autor" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->autor:'' }}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tecnica y Material
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control" id="tecnicamaterial_id" name="tecnicamaterial_id" style="width: 100%">
                                                @forelse ($tecnicas as $t)
                                                @php
                                                    if($datosPatrimonio != null && $datosPatrimonio->tecnicamaterial_id==$t->id){
                                                        $seleccionado = 'selected';
                                                    }else{
                                                        $seleccionado = '';
                                                    }
                                                @endphp

                                                <option value="{{ $t->id }}" {{ $seleccionado }}>{{ $t->nombre }}</option>
                                                @empty
                                
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> No de Inventario
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inventario" name="inventario" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->inventario:'' }}"/>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Codigo
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="codigo" name="codigo" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->codigo:'' }}" required />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> No de Inventario Anterior
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inventario_anterior" name="inventario_anterior" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->inventario_anterior:'' }}"/>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Origen
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="origen" name="origen" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->origen:'' }}" />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Obtencion
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="obtencion" name="obtencion" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->obtencion:'' }}" />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Fecha Adquisision <b>{{ ($datosPatrimonio != null) ? $datosPatrimonio->fecha_adquisicion_texto:'' }}</b>
                                                <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->fecha_adquisicion:'' }}" />
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Marcas/Inscripciones
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="marcas">{{ ($datosPatrimonio != null)?$datosPatrimonio->marcas:'' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Descripcion
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="descripcion">{{ ($datosPatrimonio != null)?$datosPatrimonio->descripcion:'' }}</textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                    @php
                                        if($datosPatrimonio != null){
                                            $estadosPatrimonio = App\Estado::where('patrimonio_id', $datosPatrimonio->id)
                                                                                            ->first();
                                        }else{
                                            $estadosPatrimonio = null;
                                        }
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Proteccion Legal</label>
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="monumento_nacional" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->monumento_nacional=="Si")?"checked":'':'' }} />
                                                    <span></span>Monumento Nacional</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="resolucion_municipal" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->resolucion_municipal=="Si")?"checked":'':'' }} />
                                                    <span></span>Resolucion Municipal</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="resolucion_administrativa" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->resolucion_administrativa=="Si")?"checked":'':'' }}>
                                                    <span></span>Resolucion Administrativa</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="individual" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->individual=="Si")?"checked":'':'' }}>
                                                    <span></span>Individual</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="conjunto" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->conjunto=="Si")?"checked":'':'' }}>
                                                    <span></span>De Conjunto</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="ninguna" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->ninguna=="Si")?"checked":'':'' }}>
                                                    <span></span>Ninguna</label>
                                            </div>
                                            {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Estado de conservacion</label>
                                           
                                            <select class="form-control" id="estado_conservacion" name="estado_conservacion" style="width: 100%">
                                                <option value="Excelente" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->estado_conservacion=="Excelente")?"selected":'':'' }}>Excelente</option>
                                                <option value="Bueno" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->estado_conservacion=="Bueno")?"selected":'':'' }}>Bueno</option>
                                                <option value="Regular" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->estado_conservacion=="Regular")?"selected":'':'' }}>Regular</option>
                                                <option value="Malo" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->estado_conservacion=="Malo")?"selected":'':'' }}>Malo</option>
                                                <option value="Pesimo" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->estado_conservacion=="Pesimo")?"selected":'':'' }}>Pesimo</option>
                                                <option value="Fragmento" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->estado_conservacion=="Fragmento")?"selected":'':'' }}>Fragmento</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Condiciones de Seguridad</label>
                                            <select class="form-control" id="condiciones_seguridad" name="condiciones_seguridad" style="width: 100%">
                                                <option value="Buena" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->condiciones_seguridad=="Buena")?"selected":'':'' }}>Buena</option>
                                                <option value="Razonable" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->condiciones_seguridad=="Razonable")?"selected":'':'' }}>Razonable</option>
                                                <option value="Ninguna" {{ ($estadosPatrimonio!=null)?($estadosPatrimonio->condiciones_seguridad=="Ninguna")?"selected":'':'' }}>Ninguna</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                </div>
                                {{-- FIN IDENTIFICACION --}}

                            </div>

                            <div class="tab-pane fade" id="analisis" role="tabpanel" aria-labelledby="contact-tab-1">
                                {{-- ANALISIS --}}
                                <div class="row">
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> ESPECIFICACIONES SOBRE EL ESTADO DE CONSERVACION
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="5" name="especificacion_conservacion">{{ ($datosPatrimonio != null)?$datosPatrimonio->especificacion_conservacion:'' }}</textarea>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> INTERVENCIONES REALIZADAS
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="5" name="intervenciones_realizadas">{{ ($datosPatrimonio != null)?$datosPatrimonio->intervenciones_realizadas:'' }}</textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> CARACTERISTICAS TECNICAS
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="5" name="caracteristicas_tecnicas">{{ ($datosPatrimonio != null)?$datosPatrimonio->caracteristicas_tecnicas:'' }}</textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> CARACTERISTICAS ICONOGRAFICAS/ORNAMENTALES
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="5" name="caracteristicas_iconograficas">{{ ($datosPatrimonio != null)?$datosPatrimonio->caracteristicas_iconograficas:'' }}</textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> DATOS HISTORICOS
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="5" name="datos_historicos">{{ ($datosPatrimonio != null)?$datosPatrimonio->datos_historicos:'' }}</textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> REFERENCIAS BIBLIOGRAFICAS/ARCHIVISTAS
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="5" name="referencias_bibliograficas">{{ ($datosPatrimonio != null)?$datosPatrimonio->referencias_bibliograficas:'' }}</textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> OBSERVACIONES
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control" rows="5" name="observaciones">{{ ($datosPatrimonio != null)?$datosPatrimonio->observaciones:'' }}</textarea>
                                        </div>
                                    </div>
                                
                                </div>

                                <div class="row">
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> CATALOGO
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="catalogo" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->catalogo:'' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> FECHA CATALOGO <b>{{ ($datosPatrimonio != null)?$datosPatrimonio->fecha_catalogo:'' }}</b>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" class="form-control" name="fec_catalogo" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->fec_catalogo:'' }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> ELABORO
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="elaboro" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->elaboro:'' }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> FECHA ELABORO <b>{{ ($datosPatrimonio != null)?$datosPatrimonio->fecha_elaboro:'' }}</b>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" class="form-control" name="fec_elaboro" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->fec_elaboro:'' }}" />
                                        </div>
                                    </div>
                                
                                </div>

                                <div class="row">
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> REVISO
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="reviso" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->reviso:'' }}">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> FECHA REVISO <b>{{ ($datosPatrimonio != null)?$datosPatrimonio->fecha_reviso:'' }}</b>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" class="form-control" name="fec_reviso" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->fec_reviso:'' }}" />
                                        </div>
                                    </div>
                                
                                </div>

                                {{-- FIN ANALISIS --}}
                            </div>

                            <div class="tab-pane fade" id="archivos" role="tabpanel" aria-labelledby="profile-tab-1">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="archivo[]" id="customFile" onchange="showMyImage(this, 1)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="thumbnil_1" class="img-fluid" style="margin-top: 10px;" />
                                        <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_1" style="display:none;" onclick="quitarImagen(1)">Quitar Imagen</button>
                                        
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                    <div class="col-md-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="archivo[]" id="customFile" onchange="showMyImage(this, 2)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="thumbnil_2" class="img-fluid" style="margin-top: 10px;" />
                                        <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_2" style="display:none;"
                                            onclick="quitarImagen(2)">Quitar Imagen</button>
                                    
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                    <div class="col-md-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="archivo[]" id="customFile" onchange="showMyImage(this, 3)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="thumbnil_3" class="img-fluid" style="margin-top: 10px;" />
                                        <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_3" style="display:none;"
                                            onclick="quitarImagen(3)">Quitar Imagen</button>
                                    
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                    <div class="col-md-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="archivo[]" id="customFile" onchange="showMyImage(this, 4)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="thumbnil_4" class="img-fluid" style="margin-top: 10px;" />
                                        <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_4" style="display:none;"
                                            onclick="quitarImagen(4)">Quitar Imagen</button>
                                    
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="profile-tab-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        {{-- subida de documentos --}}
                                        <div id="documentos_1">
                                            <div class="form-group row" id="documentos_1">
                                                <div data-repeater-list="doc" class="col-lg-12">
                                        
                                                    <div data-repeater-item class="form-group row align-items-center">
                                                        <div class="col-md-12">
                                                            
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Documento:</label>
                                                            <input type="text" class="form-control" placeholder="Resolucion Ministerial" name="nombre_documento[]" />
                                                            <div class="d-md-none mb-2"></div>
                                                        </div>
                                        
                                                        <div class="col-md-2">
                                                            <label>Kcb:</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="documento[]" id="customFile" />
                                                                <label class="custom-file-label" for="customFile">Elegir</label>
                                                            </div>
                                                        </div>
                                        
                                                        <div class="col-md-3">
                                                            <br />
                                                            <a href="javascript:;" data-repeater-delete=""
                                                                class="btn btn-block font-weight-bolder btn-light-danger">
                                                                <i class="la la-trash-o"></i>Eliminar Documento
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href="javascript:;" data-repeater-create="" class="btn btn-block font-weight-bolder btn-light-primary">
                                                        <i class="la la-plus"></i>Adicionar Ejemplar
                                                    </a>
                                                </div>
                                            </div>
                                        
                                            <br />
                                        
                                        </div>
                                        {{-- fin subida de documentos --}}
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>            

                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-success mr-2 btn-block" onclick="guarda()">Guardar</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('User/listado') }}" class="btn btn-secondary btn-block">Volver</a>
                        </div>
                    </div>

                </div>
                
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    
</div>

@stop

@section('js')
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }} "></script>

    <script type="text/javascript">

        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery(document).ready(function() {
        
            $('#documentos_1').repeater({
                initEmpty: false,
            
                defaultValues: {
                    'text-input': 'foo'
                },
                
                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {                
                    $(this).slideUp(deleteElement);                 
                },
                
                isFirstItemUndeletable: true
            });
        
        });

        function guarda()
        {
            if ($("#formularioPersona")[0].checkValidity()) {

                $("#formularioPersona").submit();
                Swal.fire("Excelente!", "Se guardo el patrimonio!", "success");

            }else{
                $("#formularioPersona")[0].reportValidity();
            }
        }

        function canbiaDepartamento()
        {
            let departamento = $("#departamento").val();

            $.ajax({
                url: "{{ url('User/ajaxDistrito') }}",
                data: {departamento: departamento},
                type: 'POST',
                success: function(data) {
                    $("#ajaxDistritos").html(data);
                    // $("#listadoProductosAjax").html(data);
                }
            });

        }

        function showMyImage(fileInput, numero) {

            var files = fileInput.files;
            $("#btnRimg_"+numero).show();
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    continue;
                }
                var img = document.getElementById("thumbnil_"+numero);
                img.file = file;
                var reader = new FileReader();
                reader.onload = (function (aImg) {
                    return function (e) {
                        aImg.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(file);
            }
        }

        function quitarImagen(numero)
        {
            $("#thumbnil_"+numero).attr('src', "{{ asset('assets/blanco.jpg') }}");    
        }

    </script>
@endsection
