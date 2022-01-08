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
            <h3 class="card-label">PATRIMONIOS POR CONTROLAR
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

            <form action="{{ url('patrimonio/generaExcel') }}" id="formularioBusqueda" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Codigo </label>
                            <input type="number" class="form-control" id="codigo" name="codigo" placeholder="3421" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Codigo Administrativo</label>
                            <input type="text" class="form-control" id="codigo_administrativo"
                                name="codigo_administrativo" placeholder="4027-03-OAGI-0089" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Titulo </label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="PAREJA VERDE" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">AUTOR
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control seleccionadores" id="autor_busqueda" name="autor_busqueda"
                                style="width: 100%">
                                <option value="">Seleccione</option>
                                @forelse ($autores as $a)
                                <option value="{{ $a->autor }}">{{ $a->autor }}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div style="height: 23px;"></div>
                            <button type="button" id="btnBusqueda" class="btn btn-info font-weight-bolder btn-block"
                                onclick="buscaPatrimonio();">BUSCAR</button>
                            <button type="button" id="btnEspera" style="display:none;"
                                class="btn btn-block btn-light-success spinner spinner-darker-success spinner-left mr-3"
                                disabled>
                                ESTAMOS TRABAJANDO EN TU BUSQUEDA, PACIENCIA POR FAVOR. <i
                                    class="icon-xl far fa-smile-wink"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div style="height: 23px;"></div>
                            <button type="button" id="btnExcel" class="btn btn-success font-weight-bolder btn-block"
                                onclick="generaExcel();">GENERAR EXCEL</button>
                            <button type="button" id="btnEsperaExcel" style="display:none;"
                                class="btn btn-block btn-light-success spinner spinner-darker-success spinner-left mr-3"
                                disabled>
                                ESTAMOS TRABAJANDO EN TU BUSQUEDA, PACIENCIA POR FAVOR. <i
                                    class="icon-xl far fa-smile-wink"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </form>
            <div class="table-responsive m-t-40" id="cargaDatos">

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
            url: "{{ url('patrimonio/ajaxListadoRevisiones') }}",
            // data: datosFormulario,
            type: 'POST',
            success: function(data) {
                $("#cargaDatos").html(data);
            }
        });    


    });

    function buscaPatrimonio(){

        $("#btnBusqueda").hide();
        $("#btnEspera").show();

        let datosFormulario = $("#formularioBusqueda").serializeArray();
        $.ajax({
            url: "{{ url('patrimonio/ajaxListado') }}",
            data: datosFormulario,
            type: 'POST',
            success: function(data) {
                $("#cargaDatos").html(data);

                $("#btnBusqueda").show();
                $("#btnEspera").hide();

                $('.seleccionadores').val(null).trigger('change');
            }
        });    
    }

    function generaExcel(){

        $("#btnExcel").hide();
        $("#btnEsperaExcel").show();
        $("#formularioBusqueda").submit();
        $('.seleccionadores').val(null).trigger('change');

        setTimeout(function () {
            $("#btnExcel").show();
            $("#btnEsperaExcel").hide();
        }, 8000);

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