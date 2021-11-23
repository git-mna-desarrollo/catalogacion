@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">PATRIMONIOS
            </h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="{{ url('patrimonio/formulario/0') }}" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
                <i class="fa fa-plus-square"></i> NUEVO PATRIMONIO
            </a>
            <!--end::Button-->
        </div>
    </div>

    <div class="card-body">
        <!--begin: Datatable-->
        <div class="table-responsive m-t-40">
            <form action="#" id="formularioBusqueda">
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Codigo </label>
                            <input type="number" class="form-control" id="codigo" name="codigo" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nombre </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputPassword1">ESPECIALIDAD
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control seleccionadores" id="especialidad_id" name="especialidad_id" style="width: 100%">
                                <option value="">Seleccione</option>
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
                            <select class="form-control seleccionadores" id="estilo_id" name="estilo_id" style="width: 100%">
                                <option value="">Seleccione</option>
                                @forelse ($estilos as $es)
                                <option value="{{ $es->id }}">{{ $es->nombre }}</option>
                                @empty
                    
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tecnica y Material
                                <span class="text-danger">*</span></label>
                            <select class="form-control seleccionadores" id="tecnicamaterial_id" name="tecnicamaterial_id" style="width: 100%">
                                <option value="">Seleccione</option>
                                @forelse ($tecnicas as $t)
                                <option value="{{ $t->id }}">{{ $t->nombre }}</option>
                                @empty
                    
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <div style="height: 23px;"></div>
                            <button type="button" class="btn btn-success font-weight-bolder" onclick="buscaPatrimonio();">BUSCAR</button>
                        </div>
                    </div>
                    
                </div>
            </form>
            <div class="table-responsive m-t-40" id="cargaDatos">
            <table class="table table-bordered table-hover table-striped" id="tabla-patrimonios">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Estilo</th>
                        <th>Tecnica/Material</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patrimonios as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->codigo }}</td>
                        <td>{{ $p->nombre }}</td>
                        <td>{{ $p->especialidad->nombre }}</td>
                        <td>{{ $p->estilo->nombre }}</td>
                        <td>
                            @if ($p->tecnicamaterial_id != null)
                                {{ $p->tecnicamaterial->nombre }}
                            @else
                                
                            @endif
                        </td>
                        <td>
                            <a
                                href="{{ url('patrimonio/formulario', [$p->id]) }}" 
                                type="button" 
                                class="btn btn-sm btn-icon btn-warning" 
                                onclick="edita('{{ $p->id }}'">
                            <i class="flaticon2-edit"></i>
                            </a>

                            <a
                                href="{{ url('patrimonio/ficha')}}/{{ $p->id }}" 
                                class="btn btn-sm btn-icon btn-primary" 
                                onclick="edita('{{ $p->id }}'">
                            <i class="flaticon2-paper"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-icon btn-danger"
                                onclick="elimina('{{ $p->id }}', '{{ $p->nombre }}')">
                                <i class="flaticon2-cross"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <h3 class="text-danger">NO EXISTEN PATRIMONIOS</h3>
                    @endforelse
                </tbody>
                <tbody>
                </tbody>
            </table>
            </div>
        </div>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {

        //cargamos a los script para select 2
        $('.seleccionadores').select2({
            placeholder: "Seleccione"
        });


        // cargamos lo datos del datatable
        $.ajax({
            url: "{{ url('patrimonio/ajaxListado') }}",
            // data: datosFormulario,
            type: 'POST',
            success: function(data) {
                $("#cargaDatos").html(data);
            }
        });    


    });

    function buscaPatrimonio(){

        let datosFormulario = $("#formularioBusqueda").serializeArray();
        $.ajax({
            url: "{{ url('patrimonio/ajaxListado') }}",
            data: datosFormulario,
            type: 'POST',
            success: function(data) {
                $("#cargaDatos").html(data);
            }
        });    
    }

        

    function nuevo()
    {
        // pone los inputs vacios
        $("#titulo_id").val('');
        $("#nombre").val('');
        $("#descripcion").val('');
        // abre el modal
        $("#modalRaza").modal('show');
    }

    function edita(id, nombre, descripcion)
    {
        // colocamos valores en los inputs
        $("#titulo_id").val(id);
        $("#nombre").val(nombre);
        $("#descripcion").val(descripcion);

        // mostramos el modal
        $("#modalRaza").modal('show');
    }

    function crear()
    {
        // verificamos que el formulario este correcto
        if($("#formulario-tipos")[0].checkValidity()){
            // enviamos el formulario
            $("#formulario-tipos").submit();
            // mostramos la alerta
            Swal.fire("Excelente!", "Registro Guardado!", "success");
        }else{
            // de lo contrario mostramos los errores
            // del formulario
            $("#formulario-tipos")[0].reportValidity()
        }

    }

    function elimina(id, nombre)
    {
        // mostramos la pregunta en el alert
        Swal.fire({
            title: "Quieres eliminar "+nombre,
            text: "Ya no podras recuperarlo!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, borrar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then(function(result) {
            // si pulsa boton si
            if (result.value) {

                window.location.href = "{{ url('patrimonio/elimina') }}/"+id;

                Swal.fire(
                    "Borrado!",
                    "El registro fue eliminado.",
                    "success"
                )
                // result.dismiss can be "cancel", "overlay",
                // "close", and "timer"
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelado",
                    "La operacion fue cancelada",
                    "error"
                )
            }
        });
    }

</script>
@endsection