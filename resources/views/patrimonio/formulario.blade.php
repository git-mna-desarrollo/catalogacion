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
            {{-- @dd($datosPatrimonio->tecnicas) --}}
            {{-- @php
                $tecnicasDateBase = explode('/',$datosPatrimonio->tecnicas);
                // dd(explode('/',$datosPatrimonio->tecnicas));
                // dd(count($tecnicasDateBase));
                if(count($tecnicasDateBase) > 0){
                    echo $tecnicasDateBase[0]."<br>";
                    unset($tecnicasDateBase[0]);
                }

                if(count($tecnicasDateBase) > 0){
                    echo $tecnicasDateBase[1]."<br>";
                    unset($tecnicasDateBase[1]);
                }

                if(count($tecnicasDateBase) > 0){
                    echo $tecnicasDateBase[2]."<br>";
                    unset($tecnicasDateBase[2]);
                }
                dd($tecnicasDateBase);
            @endphp --}}
            <!--begin::Form-->
            {{-- @dd($tecnicas) --}}
            {{-- @php
                foreach ($tecnicas as $key =>$t){
                    echo ($key+1)."-<>".$t->nombre."<br>";
                }
            @endphp --}}

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
                            @if (Auth::user()->perfil == 'Administrativo' || Auth::user()->perfil == 'Administrador')
                                
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab-1" data-toggle="tab" href="#documentos" aria-controls="contact">
                                    <span class="nav-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </span>
                                    <span class="nav-text">ADMINISTRATIVO</span>
                                </a>
                            </li>

                            @endif

                        </ul>
                        <div class="tab-content mt-5" id="myTabContent1">
                            <div class="tab-pane fade show active" id="ubicacion" role="tabpanel" aria-labelledby="home-tab-1">

                                {{-- ubicacion --}}
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">DEPARTAMENTO </label>
                                            {{-- <input type="text" class="form-control" id="departamento" name="departamento" value="LA PAZ" /> --}}
                                            <select name="departamento" id="departamento" onchange="muestra(this)" class="form-control">
                                                <option value="LA PAZ" {{ ($datosPatrimonio !=null)? (($datosPatrimonio->departamento == 'LA PAZ')?
                                                    'selected':''): '' }}>LA PAZ</option>
                                                <option value="ORURO" {{ ($datosPatrimonio !=null)? (($datosPatrimonio->departamento == 'ORURO')?
                                                    'selected':''): '' }}>ORURO</option>
                                                <option value="POTOSI" {{ ($datosPatrimonio !=null)? (($datosPatrimonio->departamento == 'POTOSI')?
                                                    'selected':''): '' }}>POTOSI</option>
                                                <option value="COCHABAMBA" {{ ($datosPatrimonio !=null)? (($datosPatrimonio->departamento == 'COCHABAMBA')?
                                                    'selected':''): '' }}>COCHABAMBA</option>
                                                <option value="CHUQUISACA" {{ ($datosPatrimonio !=null)? (($datosPatrimonio->departamento == 'CHUQUISACA')?
                                                    'selected':''): '' }}>CHUQUISACA</option>
                                                <option value="TARIJA" {{ ($datosPatrimonio !=null)? (($datosPatrimonio->departamento == 'TARIJA')?
                                                    'selected':''): '' }}>TARIJA</option>
                                                <option value="PANDO" {{ ($datosPatrimonio !=null)? (($datosPatrimonio->departamento == 'PANDO')?
                                                    'selected':''): '' }}>PANDO</option>
                                                <option value="BENI" {{ ($datosPatrimonio !=null)? (($datosPatrimonio->departamento == 'BENI')?
                                                    'selected':''): '' }}>BENI</option>
                                                <option value="SANTA CRUZ" {{ ($datosPatrimonio !=null)? (($datosPatrimonio->departamento == 'SANTA CRUZ')?
                                                    'selected':''): '' }}>SANTA CRUZ</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">PROVINCIA </label>
                                                <div id="bloque-provincias">
                                                    @if ($datosPatrimonio != null)
                                                        <select name="provincia" id="provincia" class="form-control">
                                                            @foreach ($provincias as $pro)
                                                            <option value="{{ $pro->provincia }}" {{ ($datosPatrimonio->provincia==$pro->provincia)?'selected':'' }}>{{ $pro->provincia }}</option>
                                                            @endforeach
                                                        </select>                                                        
                                                    @else
                                                        <select name="provincia" id="provincia" class="form-control">
                                                            @foreach ($provincias as $pro)
                                                                <option value="{{ $pro->provincia }}">{{ $pro->provincia }}</option>                                                    
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>     

                                                {{-- <input type="text" class="form-control" id="provincia" name="provincia" value="MURILLO" /> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">LOCALIDAD </label>
                                            <input type="text" class="form-control" id="localidad" name="localidad" value="CIUDAD DE LA PAZ" />
                                            <input type="hidden" name="patrimonio_id" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->id:'' }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">INMUEBLE </label>
                                            {{-- <input type="text" class="form-control" id="inmueble" name="inmueble" value="MUSEO NACIONAL DE ARTE" /> --}}
                                            <select name="inmueble" id="inmueble" class="form-control">
                                                @foreach ($inmuebles as $key => $in)
                                                    <option {{ ($key == 0)? 'selected="selected"': ''}} value="{{ $in->nombre }}">{{ $in->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">CALLE </label>
                                            {{-- <input type="text" class="form-control" id="calle" name="calle" value="CALLE COMERCIO ESQ. SOCABAYA" /> --}}
                                            <input type="text" readonly="readonly" class="form-control" id="calle" name="calle"/>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">UBICACION
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-control seleccionadores" id="ubicacion_id" name="ubicacion_id" style="width: 100%">
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">SITIO
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control seleccionadores" id="sitio_id" name="ubicacion_id" style="width: 100%">
                                                @forelse ($sitios as $s)
                                                @php
                                                    if($datosPatrimonio != null && $datosPatrimonio->ubicacion_id==$s->id){
                                                        $seleccionado = 'selected'; 
                                                    }else{
                                                        $seleccionado = '';
                                                    }
                                                @endphp
                                                <option value="{{ $s->id }}" {{ $seleccionado }}>({{ $s->sigla }}) {{ $s->descripcion }}</option>
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
                                
                                    <div class="col-md-4">
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
                                            <select class="form-control" id="especialidad_id" name="especialidad_id" style="width: 100%" onchange="buacaSubEspecialidad(this)">
                                                <option value="">SELECCIONE</option>
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
                                            <label for="exampleInputPassword1">SUB ESPECIALIDAD
                                                <span class="text-danger">*</span></label>
                                                <div id="bloque-dependent-especialidad">
                                                    <select name="subEspecialidad" id="subEspecialidad" class="form-control">
                                                        @if ($datosPatrimonio != null)
                                                            @foreach ($subespecialidades as $sube)
                                                                <option value="{{ $sube->id }}" {{ ($sube->id == $datosPatrimonio->subespecialidad_id)?  'selected':'' }}>{{ $sube->nombre }}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="">SELECCIONE</option>
                                                        @endif
                                                    </select>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ESTILO
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" id="estilo_id" name="estilo_id" style="width: 100%">
                                                <option value="">SELECCIONE</option>
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
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tecnica 1
                                                <span class="text-danger">*</span>
                                            </label>
                                            @php
                                                if($datosPatrimonio !=  null){
                                                    $tecnicasDateBase = explode('/',$datosPatrimonio->tecnicas);
                                                }
                                            @endphp
                                            <select name="tecnica_1" id="tecnica_1" class="form-control">
                                                @foreach ($tecnicasSep  as $te)
                                                    {{-- <option value="{{ $te->nombre }}">{{ $te->nombre }}</option> --}}
                                                    <option value="{{ $te->nombre }}" {{ ($datosPatrimonio!=null)? (($te->nombre == $tecnicasDateBase[0])? 'selected': ''):''}}>{{ $te->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tecnica 2
                                                <span class="text-danger">*</span>
                                            </label>
                                            @php
                                                if($datosPatrimonio !=  null){
                                                    unset($tecnicasDateBase[0]);
                                                }
                                            @endphp
                                            <select name="tecnica_2" id="tecnica_2" class="form-control">
                                                <option value="">SELELCCIONE</option>
                                                @foreach ($tecnicasSep  as $te)
                                                    <option value="{{ $te->nombre }}" {{ ($datosPatrimonio !=  null)? ((count($tecnicasDateBase) > 0)? (($datosPatrimonio!=null)? (($te->nombre == $tecnicasDateBase[1])? 'selected': ''):'') : ''):''}}>{{ $te->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tecnica 3
                                                <span class="text-danger">*</span>
                                            </label>
                                            @php
                                                if($datosPatrimonio !=  null){
                                                    unset($tecnicasDateBase[1]);
                                                }
                                            @endphp
                                            <select name="tecnica_3" id="tecnica_3" class="form-control">
                                                <option value="">SELELCCIONE</option>
                                                @foreach ($tecnicasSep  as $te)
                                                    <option value="{{ $te->nombre }}"  {{($datosPatrimonio !=  null)? ((count($tecnicasDateBase) > 0)? (($datosPatrimonio!=null)? (($te->nombre == $tecnicasDateBase[2])? 'selected': ''):'') : '') : ''}} >{{ $te->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Material 1
                                                <span class="text-danger">*</span>
                                            </label>
                                            @php
                                                if($datosPatrimonio !=  null){
                                                    $materialesDateBase = explode('/',$datosPatrimonio->materiales);
                                                }
                                            @endphp
                                            <select name="material_1" id="material_1" class="form-control">
                                                @foreach ($materiales as $mat)
                                                    <option value="{{ $mat->nombre }}" {{ ($datosPatrimonio!=null)? (($mat->nombre == $materialesDateBase[0])? 'selected': ''):''}}>{{ $mat->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Material 2
                                                <span class="text-danger">*</span>
                                            </label>
                                            @php
                                            if($datosPatrimonio !=  null){
                                                unset($materialesDateBase[0]);
                                            }
                                            @endphp
                                            <select name="material_2" id="material_2" class="form-control">
                                                <option value="">SELELCCIONE</option>
                                                @foreach ($materiales as $mat)
                                                    <option value="{{ $mat->nombre }}" {{($datosPatrimonio !=  null)? ((count($materialesDateBase) > 0)? (($datosPatrimonio!=null)? (($mat->nombre == $materialesDateBase[1])? 'selected': ''):'') : '') : ''}}>{{ $mat->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Material 3
                                                <span class="text-danger">*</span>
                                            </label>
                                            @php
                                            if($datosPatrimonio !=  null){
                                                unset($materialesDateBase[1]);
                                            }
                                            @endphp
                                            <select name="material_3" id="material_3" class="form-control">
                                                <option value="">SELELCCIONE</option>
                                                @foreach ($materiales as $mat)
                                                    <option value="{{ $mat->nombre }}" {{ ($datosPatrimonio !=  null)? ((count($materialesDateBase) > 0)? (($datosPatrimonio!=null)? (($mat->nombre == $materialesDateBase[2])? 'selected': ''):'') : '') : ''}}>{{ $mat->nombre }}</option>
                                                @endforeach
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
                                            {{-- <input type="text" class="form-control" id="obtencion" name="obtencion" value="{{ ($datosPatrimonio != null)?$datosPatrimonio->obtencion:'' }}" /> --}}
                                            <select name="obtencion" id="obtencion" class="form-control">
                                                <option value="Tramsferencia" {{ ($datosPatrimonio != null)?(($datosPatrimonio->obtencion == 'Tramsferencia')? 'selected': ''):''  }} >Tramsferencia</option>
                                                <option value="Compra" {{ ($datosPatrimonio != null)?(($datosPatrimonio->obtencion == 'Compra')? 'selected': ''):''  }} >Compra</option>
                                                <option value="Donacion" {{ ($datosPatrimonio != null)?(($datosPatrimonio->obtencion == 'Donacion')? 'selected': ''):''  }} >Donacion</option>
                                            </select>
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
                                            <input type="text" class="form-control" name="catalogo"
                                                value="{{ ($datosPatrimonio != null)?$datosPatrimonio->catalogo:'' }}">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> FECHA CATALOGO <b>{{ ($datosPatrimonio !=
                                                    null)?$datosPatrimonio->fecha_catalogo:'' }}</b>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" class="form-control" name="fec_catalogo"
                                                value="{{ ($datosPatrimonio != null)?$datosPatrimonio->fec_catalogo:'' }}" />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> ELABORO
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="elaboro"
                                                value="{{ ($datosPatrimonio != null)?$datosPatrimonio->elaboro:'' }}">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> FECHA ELABORO <b>{{ ($datosPatrimonio !=
                                                    null)?$datosPatrimonio->fecha_elaboro:'' }}</b>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" class="form-control" name="fec_elaboro"
                                                value="{{ ($datosPatrimonio != null)?$datosPatrimonio->fec_elaboro:'' }}" />
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> REVISO
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="reviso"
                                                value="{{ ($datosPatrimonio != null)?$datosPatrimonio->reviso:'' }}">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> FECHA REVISO <b>{{ ($datosPatrimonio !=
                                                    null)?$datosPatrimonio->fecha_reviso:'' }}</b>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" class="form-control" name="fec_reviso"
                                                value="{{ ($datosPatrimonio != null)?$datosPatrimonio->fec_reviso:'' }}" />
                                        </div>
                                    </div>
                                
                                </div>

                                {{-- FIN ANALISIS --}}
                            </div>

                            <div class="tab-pane fade" id="archivos" role="tabpanel" aria-labelledby="profile-tab-1">
                                <div class="row" id="cargaImagenes">
                                    @if ($imagenes != null)
                                        @foreach ($imagenes as $i)
                                            <div class="col-md-3">

                                                <div class="card card-custom card-fit gutter-b">
                                                    <div class="card-header ribbon ribbon-top ribbon-ver">
                                                        @if ($i->estado == 'Ficha')
                                                        <div class="ribbon-target bg-warning" style="top: -2px; right: 20px;">
                                                            <i class="fa fa-star text-white"></i>
                                                        </div>
                                                        @endif
                                                        {{-- <h3 class="card-title">
                                                            Vertical Ribbons
                                                        </h3> --}}
                                                    </div>
                                                    <div class="card-body">
                                                        <img src="{{ asset("imagenes/$i->imagen") }}" class="img-fluid">
                                                        <button type="button" class="btn btn-danger mr-2 btn-block" onclick="quitarImagen({{ $i->id }})">Quitar Imagen</button>
                                                    </div>
                                                </div>
                                            </div>    
                                        @endforeach
                                    @endif
                                </div>

                                <p>&nbsp;</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="text-primary">
                                            SUBIR IMAGENES
                                        </h2>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    
                                    <div class="col-md-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="archivo[]" id="customFile_1" onchange="showMyImage(this, 1)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                            <label class="radio radio-lg">
                                                <input type="radio" name="imagen_en_ficha" value="0" checked="checked" />
                                                <span></span>
                                                &nbsp; Imagen en ficha
                                            </label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="thumbnil_1" class="img-fluid" style="margin-top: 10px;" />
                                        <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_1" style="display:none;"
                                            onclick="mueveImagen(1)">Quitar Imagen
                                        </button>
                                    
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                    <div class="col-md-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="archivo[]" id="customFile_2" onchange="showMyImage(this, 2)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                            <label class="radio radio-lg">
                                                <input type="radio" name="imagen_en_ficha" value="1" />
                                                <span></span>
                                                &nbsp; Imagen en ficha
                                            </label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="thumbnil_2" class="img-fluid" style="margin-top: 10px;" />
                                        <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_2" style="display:none;"
                                            onclick="mueveImagen(2)">Quitar Imagen</button>
                                    
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                    <div class="col-md-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="archivo[]" id="customFile_3" onchange="showMyImage(this, 3)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                            <label class="radio radio-lg">
                                                <input type="radio" name="imagen_en_ficha" value="2" />
                                                <span></span>
                                                &nbsp; Imagen en ficha
                                            </label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="thumbnil_3" class="img-fluid" style="margin-top: 10px;" />
                                        <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_3" style="display:none;"
                                            onclick="mueveImagen(3)">Quitar Imagen</button>
                                    
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                    <div class="col-md-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="archivo[]" id="customFile_4" onchange="showMyImage(this, 4)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                            <label class="radio radio-lg">
                                                <input type="radio" name="imagen_en_ficha" value="3" />
                                                <span></span>
                                                &nbsp; Imagen en ficha
                                            </label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="thumbnil_4" class="img-fluid" style="margin-top: 10px;" />
                                        <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_4" style="display:none;"
                                            onclick="mueveImagen(4)">Quitar Imagen</button>
                                    
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="profile-tab-1">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>CODIGO FCB:</label>
                                        <input type="text" class="form-control" placeholder="Resolucion Ministerial" name="nombre_documento[]" />
                                        <div class="d-md-none mb-2"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>CUENTA:</label>
                                        {{-- <input type="text" class="form-control" placeholder="Resolucion Ministerial" name="nombre_documento[]" /> --}}
                                        <select name="cuenta_id" id="cuenta_id" class="form-control">
                                            @foreach ($cuentas as $cuen)
                                                <option value="{{ $cuen->id }}"{{ ($datosPatrimonio != null)? (($datosPatrimonio->cuenta_id == $cuen->id)? 'selected': ''): '' }}>{{ $cuen->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="d-md-none mb-2"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>SUBCUENTA:</label>
                                        <input type="text" class="form-control" placeholder="Resolucion Ministerial" name="sub_cuenta" id="sub_cuenta" value="{{ ($datosPatrimonio != null)? $datosPatrimonio->sub_cuenta : ''}}"/>
                                        <div class="d-md-none mb-2"></div>
                                    </div>

                                </div>

                                <div class="row" id="cargaDocumentos">
                                    <div class="col-md-12">
                                        @if ($documentos != null)
                                            <table class="table table-striped table">
                                                <thead>
                                                    <tr>
                                                        <th>DOCUMENTOS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($documentos as $d)
                                                <tr>
                                                    <td>
                                                        {{ $d->nombre }}
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <button type="button" class="btn btn-sm btn-icon btn-danger"
                                                            onclick="mueveDocumento('{{ $d->id }}', '{{ $d->nombre }}')">
                                                            <i class="flaticon2-cross"></i>
                                                        </button>
                                                    </td>
                                                </tr>        
                                                @endforeach
                                                </tbody>
                                            </table>    
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="text-primary">
                                            SUBIR DOCUMENTOS
                                        </h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nombre Documento #1:</label>
                                        <input type="text" class="form-control" placeholder="Resolucion Ministerial" name="nombre_documento[]" />
                                        <div class="d-md-none mb-2"></div>
                                    </div>
                    
                                    <div class="col-md-2">
                                        <label>Archivo:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="documento[]" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nombre Documento #2:</label>
                                        <input type="text" class="form-control" placeholder="Resolucion Ministerial" name="nombre_documento[]" />
                                        <div class="d-md-none mb-2"></div>
                                    </div>
                                
                                    <div class="col-md-2">
                                        <label>Archivo:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="documento[]" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nombre Documento #3:</label>
                                        <input type="text" class="form-control" placeholder="Resolucion Ministerial" name="nombre_documento[]" />
                                        <div class="d-md-none mb-2"></div>
                                    </div>
                                
                                    <div class="col-md-2">
                                        <label>Archivo:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="documento[]" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nombre Documento #4:</label>
                                        <input type="text" class="form-control" placeholder="Resolucion Ministerial" name="nombre_documento[]" />
                                        <div class="d-md-none mb-2"></div>
                                    </div>
                                
                                    <div class="col-md-2">
                                        <label>Archivo:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="documento[]" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @if (Auth::user()->tipo == 'Catalogador')
                        <h4>&nbsp;</h4>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label></label>
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-lg">
                                        <input type="checkbox" name="trabajo_terminado" />
                                        <span></span>TRABAJO TERMINADO</label>
                                </div>
                                {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
                            </div>
                        </div>
                        <h4>&nbsp;</h4>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <h4><span class="text-primary">CATALOGADOR: </span> Osvaldo Cruz</h4>
                        </div>
                        <div class="col-md-4">
                            <h4><span class="text-primary">REVISOR: </span> </h4>
                        </div>
                        <div class="col-md-4">
                            <h4><span class="text-primary">APROBADOR: </span> </h4>
                        </div>
                    </div>

                    <h4>&nbsp;</h4>

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

            $('.seleccionadores').select2({
                placeholder: "Seleccione"
            });
        
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
            console.log(numero);
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
            Swal.fire({
                title: "Desea eliminar la imagen",
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
                // si pulsa boton si
                if (result.value) {

                    ajaxEliminaImagen(numero);

                    Swal.fire(
                        "Borrado!",
                        "El registro fue eliminado.",
                        "success"
                    )
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelado",
                        "La operacion fue cancelada",
                        "error"
                    )
                }
            });
        }

        function ajaxEliminaImagen(numero)
        {
            $.ajax({
                url: "{{ url('imagen/ajaxElimina') }}",
                data: {idImagen: numero},
                type: 'POST',
                success: function(data) {
                    $("#cargaImagenes").html(data);
                    // $("#listadoProductosAjax").html(data);
                }
            });    
        }

        function ajaxEliminaDocumento(id)
        {
            $.ajax({
                url: "{{ url('documento/ajaxElimina') }}",
                data: {id: id},
                type: 'POST',
                success: function(data) {
                    $("#cargaDocumentos").html(data);
                    // $("#listadoProductosAjax").html(data);
                }
            });    
        }

        function mueveDocumento(id, nombre)
        {
            // $("#thumbnil_"+numero).attr('src', "{{ asset('assets/blanco.jpg') }}");   
            Swal.fire({
                title: "Desea eliminar: "+nombre,
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
                // si pulsa boton si
                if (result.value) {

                    ajaxEliminaDocumento(id);

                    Swal.fire(
                        "Borrado!",
                        "El registro fue eliminado.",
                        "success"
                    )
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelado",
                        "La operacion fue cancelada",
                        "error"
                    )
                }
            });
        }

        function mueveImagen(numero){
            $("#thumbnil_"+numero).attr('src', "{{ asset('assets/blanco.jpg') }}");
            $("#customFile_"+numero).val('');
        }

        // $.ajax({
        //     url: "{{ url('patrimonio/ajaxBuscaProvincia') }}",
        //     data: {provincia: provincia},
        //     type: 'POST',
        //     success: function(data) {
        //         $("#bloque-provincias").html(data);
        //     }
        // });  


        function muestra(departamento){
            // console.log(departamento.value);
            var provincia = departamento.value;
            $.ajax({
                url: "{{ url('patrimonio/ajaxBuscaProvincia') }}",
                data: {provincia: provincia},
                type: 'POST',
                success: function(data) {
                    $("#bloque-provincias").html(data);
                    // $("#listadoProductosAjax").html(data);
                }
            });  
        }

        $('#calle').val($("#inmueble option:selected").text());
        
        $(document).on('change', '#inmueble', function(event) {
            $('#calle').val($("#inmueble option:selected").text());
        });

        // var valorSlecionado  = document.getElementById('especialidad_id').value;
        // $.ajax({
        //     url: "{{ url('patrimonio/ajaxBuscaSubEspecialidad') }}",
        //     data: {valorSlecionado: valorSlecionado},
        //     type: 'POST',
        //     success: function(data) {
        //         $("#bloque-dependent-especialidad").html(data);
        //     }
        // });  

        function buacaSubEspecialidad(select){

            var valorSlecionado  = select.value;
            $.ajax({
                url: "{{ url('patrimonio/ajaxBuscaSubEspecialidad') }}",
                data: {valorSlecionado: valorSlecionado},
                type: 'POST',
                success: function(data) {
                    $("#bloque-dependent-especialidad").html(data);
                }
            });  
        }

        function verifica(){
            if ($("#pizza").is(":checked")) {
                $('#pizza_kind').prop('disabled', false);
            }
            else {
                $('#pizza_kind').prop('disabled', 'disabled');
            }
        }

    </script>
@endsection
