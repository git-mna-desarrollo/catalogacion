@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    {{-- <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/plugins/custom/uppy/uppy.bundle.css') }}" rel="stylesheet" type="text/css" />
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
                                    <span class="nav-text">ARCHIVOS</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mt-5" id="myTabContent1">
                            <div class="tab-pane fade show active" id="ubicacion" role="tabpanel" aria-labelledby="home-tab-1">

                                {{-- ubicacion --}}
                                <div class="row">
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">LOCALIDAD
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" id="localidad_id" name="localidad_id" style="width: 100%">
                                                @forelse ($localidades as $l)
                                                <option value="{{ $l->id }}">{{ $l->nombre }}</option>
                                                @empty
                                
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">DEPARTAMENTO
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" id="departamento_id" name="departamento_id" style="width: 100%">
                                                @forelse ($departamentos as $d)
                                                <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                                                @empty
                                
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">PROVINCIA
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" id="provincia_id" name="provincia_id" style="width: 100%">
                                                @forelse ($provincias as $p)
                                                <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                                                @empty
                                
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">UBICACION
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" id="ubicacion_id" name="ubicacion_id" style="width: 100%">
                                                @forelse ($ubicaciones as $u)
                                                <option value="{{ $u->id }}">{{ $u->nombre }}</option>
                                                @empty
                                
                                                @endforelse
                                            </select>
                                        </div>                                        
                                    </div>
                                
                                </div>

                                <div class="row">
                                
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">DIRECCION
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">RESPONSABLE
                                                <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="responsable" name="responsable" readonly />
                                        </div>
                                    </div>
                                
                                </div>

                                {{-- fin ubicacion --}}
                            </div>
                            <div class="tab-pane fade" id="identificacion" role="tabpanel" aria-labelledby="profile-tab-1">

                                {{-- IDENTIFICACION --}}                                
                                
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
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="especialidad" name="especialidad" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Estilo
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="estilo" name="estilo" />
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
                                            <label for="exampleInputPassword1">Dimensiones (Cms.)
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="dimensiones"></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Descripcion
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="descripcion"></textarea>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Archvo Fotografico
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="archivo"></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Proteccion Legal</label>
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Monumento Nacional</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Resolucion Municipal</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Resolucion Administrativa</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Individual</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>De Conjunto</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
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
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Excelente</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Bueno</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Regular</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Malo</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Pesimo</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
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
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Buena</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
                                                    <span></span>Razonable</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="Checkboxes2">
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
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="observaciones"></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                                {{-- FIN ANALISIS --}}
                            </div>

                            <div class="tab-pane fade" id="archivos" role="tabpanel" aria-labelledby="profile-tab-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="drag-drop-area"></div>
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

    <script src="{{ url('assets/plugins/custom/uppy/uppy.bundle.js') }}"></script>
    <script src="{{ url('assets/js/pages/crud/file-upload/uppy.js') }}"></script>
    <script src="https://releases.transloadit.com/uppy/locales/v2.0.2/es_ES.min.js"></script>

    <script type="text/javascript">

        
            var uppy = new Uppy.Core()
                .use(Uppy.Dashboard, {
                  inline: true,
                  locale: Uppy.locales.es_ES,
                  target: '#drag-drop-area'
                })
                .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})
        
              uppy.on('complete', (result) => {
                console.log('Upload complete! We’ve uploaded these files:', result.successful)
              })

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

    </script>
@endsection
