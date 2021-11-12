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
                                                <input type="text" class="form-control" id="localidad" name="localidad" value="CIUDAD DE LA PAZ" disabled />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">PROVINCIA </label>
                                                <input type="text" class="form-control" id="provincia" name="provincia" value="MURILLO" disabled />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">DEPARTAMENTO </label>
                                                <input type="text" class="form-control" id="departamento" name="departamento" value="LA PAZ" disabled />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">INMUEBLE </label>
                                            <input type="text" class="form-control" id="inmueble" name="inmueble" value="MUSEO NACIONAL DE ARTE" disabled />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">CALLE </label>
                                            <input type="text" class="form-control" id="calle" name="calle" value="CALLE COMERCIO ESQ. SOCABAYA" disabled />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">UBICACION
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" id="localidad_id" name="localidad_id" style="width: 100%">
                                                @forelse ($ubicaciones as $u)
                                                <option value="{{ $u->id }}">{{ $u->nombre }}</option>
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
                                            <input type="number" class="form-control" id="alto" name="alto" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ANCHO
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="ancho" name="ancho" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">DIAMETRO
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="diametro" name="diametro" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">CIRCUNFERENCIA
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="circunferencia" name="circunferencia" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">LARGO
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="largo" name="largo" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">PROFUNDIDAD
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="ancho" name="ancho" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">PESO 
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="peso" name="peso" />
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">DESIGNACION/NOMBRE
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ESPECIALIDAD
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" id="especialidad_id" name="especialidad_id" style="width: 100%">
                                                @forelse ($especialidades as $e)
                                                <option value="{{ $e->id }}">{{ $e->nombre }}</option>
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
                                                <option value="{{ $es->id }}">{{ $es->nombre }}</option>
                                                @empty
                                    
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Escuela
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="escuela" name="escuela" />
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Epoca y/o Fecha
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="epoca" name="epoca" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Autor/Atribucion
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="autor" name="autor" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tecnica y Material
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control" id="tecnicamaterial_id" name="tecnicamaterial_id" style="width: 100%">
                                                @forelse ($tecnicas as $t)
                                                <option value="{{ $t->id }}">{{ $t->nombre }}</option>
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
                                            <input type="text" class="form-control" id="inventario" name="inventario" />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Codigo
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="codigo" name="codigo" />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> No de Inventario Anterior
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inventario_anterior" name="inventario_anterior" />
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Origen
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="origen" name="origen" />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Obtencion
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="obtencion" name="obtencion" />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Fecha Adquisision
                                                <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" />
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Marcas/Inscripciones
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="marcas"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Descripcion
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="descripcion"></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Proteccion Legal</label>
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="monumento_nacional">
                                                    <span></span>Monumento Nacional</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="resolucion_municipal">
                                                    <span></span>Resolucion Municipal</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="resolucion_administrativa">
                                                    <span></span>Resolucion Administrativa</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="individual">
                                                    <span></span>Individual</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="conjunto">
                                                    <span></span>De Conjunto</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="ninguna">
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
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Excelente">
                                                    <span></span>Excelente</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Bueno">
                                                    <span></span>Bueno</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Regular">
                                                    <span></span>Regular</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Malo">
                                                    <span></span>Malo</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Pesimo">
                                                    <span></span>Pesimo</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Fragmento">
                                                    <span></span>Fragmento</label>
                                            </div>
                                            {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Condiciones de Seguridad</label>
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Buena">
                                                    <span></span>Buena</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Razonable">
                                                    <span></span>Razonable</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Ninguna">
                                                    <span></span>Ninguna</label>
                                            </div>
                                            {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
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
                                            <textarea class="form-control" name="estado_conservacion"></textarea>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> INTERVENCIONES REALIZADAS
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="intervenciones_realizadas"></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> CARACTERISTICAS TECNICAS
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="caracteristicas_tecnicas"></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> CARACTERISTICAS ICONOGRAFICAS/ORNAMENTALES
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="caracteristicas_iconograficas"></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> DATOS HISTORICOS
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="datos_historicos"></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> REFERENCIAS BIBLIOGRAFICAS/ARCHIVISTAS
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="referencias_bibliograficas"></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> OBSERVACIONES
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control" name="observaciones"></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                {{-- FIN ANALISIS --}}
                            </div>

                            <div class="tab-pane fade" id="archivos" role="tabpanel" aria-labelledby="profile-tab-1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="archivo[]" id="customFile" onchange="showMyImage(this, 1)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="thumbnil_1" class="img-fluid" style="margin-top: 10px;" />
                                        <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_1" style="display:none;" onclick="quitarImagen(1)">Quitar Imagen</button>
                                        
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                    <div class="col-md-4">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" onchange="loadFile_2(event)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="output_2" class="img-fluid" />
                                        <script>
                                            var loadFile_2 = function(event) {
                                            var reader = new FileReader();
                                            reader.onload = function(){
                                              var output = document.getElementById('output_2');
                                              output.src = reader.result;
                                            };
                                            reader.readAsDataURL(event.target.files[0]);
                                          };
                                        </script>
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                    <div class="col-md-4">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" onchange="loadFile_3(event)" />
                                            <label class="custom-file-label" for="customFile">Elegir</label>
                                        </div>
                                        {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                        <img id="output_3" class="img-fluid" />
                                        <script>
                                            var loadFile_3 = function(event) {
                                            var reader = new FileReader();
                                            reader.onload = function(){
                                              var output = document.getElementById('output_3');
                                              output.src = reader.result;
                                            };
                                            reader.readAsDataURL(event.target.files[0]);
                                          };
                                        </script>
                                        {{-- <div id="drag-drop-area"></div> --}}
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="profile-tab-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        Aqui los documentos
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

    <script type="text/javascript">

        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
