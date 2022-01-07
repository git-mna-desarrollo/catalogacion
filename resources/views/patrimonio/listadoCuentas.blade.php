@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- INICIO DEL MODAL --}}

<div class="modal fade" id="modal-informacion" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">MAS INFORMACION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="container">
                <form action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="text-info">COD-ADMIN:</label>
                                <input type="text" class="form-control codigo-admin" id="codigo_administrativo" name="codigo_administrativo" readonly />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="text-info">COD-ADMIN:</label>
                                <input type="text" class="form-control codigo-admin" id="codigo_administrativo" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="text-info">NOMBRE:</label>
                                <input type="text" class="form-control codigo-admin" id="inf-nombre" readonly />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="text-info">AUTOR:</label>
                                <input type="text" class="form-control codigo-admin" id="inf-autor" readonly />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="text-info">EPOCA:</label>
                                <input type="text" class="form-control codigo-admin" id="inf-epoca" readonly />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="text-info">ESPECIALIDAD:</label>
                                <input type="text" class="form-control codigo-admin" id="inf-especialidad" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="text-info">ESTILO:</label>
                                <input type="text" class="form-control codigo-admin" id="inf-estilo" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="text-info">TECNICAS:</label>
                                <input type="text" class="form-control codigo-admin" id="inf-tecnicas" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                                <label for="exampleInputPassword1" class="text-info">MATERIALES:</label>
                                <input type="text" class="form-control codigo-admin" id="inf-materiales" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img id="mi_imagen"  src="" width="50%"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-light-dark font-weight-bold"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{-- END DEL MODAL --}}

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
            <form action="{{ url('patrimonio/generaExcelCuentas') }}" id="formularioBusqueda" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Codigo </label>
                            <input type="number" class="form-control" id="codigo" name="codigo" placeholder="3421" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Codigo Administrativo</label>
                            <input type="text" class="form-control" id="codigo_administrativo" name="codigo_administrativo" placeholder="4027-03-OAGI-0089" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Titulo </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="PAREJA VERDE" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">AUTOR
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2" id="autor_busqueda" name="autor_busqueda" style="width: 100%">
                                <option value="">Seleccione</option>
                                @forelse ($autores as $a)
                                    <option value="{{ $a->autor }}">{{ $a->autor }}</option>
                                @empty
                    
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Cuenta</label>
                            <select name="cuenta_busqueda" id="cuenta_busqueda" class="form-control select2">
                                <option value="">Seleccione</option>
                                @foreach ($cuentas as $cuen)
                                <option value="{{ $cuen->cuenta->id }}">{{ $cuen->cuenta->nombre }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" id=""> --}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Sub Cuenta</label>
                            <input type="text" class="form-control" id="subcuenta_busqueda" name="subcuenta_busqueda">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div style="height: 23px;"></div>
                            <button type="button" id="btnBusqueda" class="btn btn-info font-weight-bolder btn-block" onclick="buscaPatrimonio();">BUSCAR</button>
                            <button type="button" id="btnEspera" style="display:none;" class="btn btn-block btn-light-success spinner spinner-darker-success spinner-left mr-3" disabled>
                                ESTAMOS TRABAJANDO EN TU BUSQUEDA, PACIENCIA POR FAVOR. <i class="icon-xl far fa-smile-wink"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div style="height: 23px;"></div>
                            <button type="button" id="btnExcel" class="btn btn-success font-weight-bolder btn-block" onclick="generaExcel();">GENERAR EXCEL</button>
                            <button type="button" id="btnEsperaExcel" style="display:none;" class="btn btn-block btn-light-success spinner spinner-darker-success spinner-left mr-3" disabled>
                                ESTAMOS TRABAJANDO EN TU BUSQUEDA, PACIENCIA POR FAVOR. <i class="icon-xl far fa-smile-wink"></i>
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

        $(document).ready(function() {
            $(".select2").select2();
        });


        // cargamos lo datos del datatable
        $.ajax({
            url: "{{ url('patrimonio/ajaxListadoCuentas') }}",
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
            url: "{{ url('patrimonio/ajaxListadoCuentas') }}",
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