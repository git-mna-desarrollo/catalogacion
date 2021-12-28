@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- inicio modal --}}

<!-- Modal-->
<div class="modal fade" id="modal-es" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE MOVIMIENTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('movimiento/guarda') }}" method="POST" id="formulario-movimiento">
                    @csrf
                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Asignado
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="hidden" name="patrimonio_id" id="patrimonio_id" value="{{ $datosPatrimonio->id }}">
                                <select class="form-control seleccionadores" id="asignado_id" name="asignado_id" style="width: 100%">
                                    <option value="">Seleccione</option>
                                    @forelse ($usuarios as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @empty
                        
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Fecha
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ubicacion
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control seleccionadores" id="destino_id" name="destino_id" style="width: 100%">
                                    @forelse ($ubicaciones as $ub)
                                        <option value="{{ $ub->id }}">{{ $ub->nombre }}</option>
                                    @empty
                        
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sitio
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control seleccionadores" id="sitio_id" name="sitio_id" style="width: 100%">
                                    @forelse ($sitios as $s)
                                        <option value="{{ $s->id }}">{{ $s->descripcion }} ({{ $s->sigla }})</option>
                                    @empty
                        
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Observaciones
                                    <span class="text-danger">*</span></label>
                                <textarea id="observaciones" name="observaciones" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-light-dark font-weight-bold"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-sm btn-success font-weight-bold" onclick="crear()">Guardar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal --}}

<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">MOVIMIENTOS
            </h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
                <i class="fa fa-plus-square"></i> NUEVO MOVIMIENTO
            </a>
            <!--end::Button-->
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h3><span class="text-primary">CODIGO: </span> {{ $datosPatrimonio->codigo_administrativo }}</h3>
            </div>

            <div class="col-md-4">
                <h3><span class="text-primary">NOMBRE: </span> {{ $datosPatrimonio->nombre }}</h3>
            </div>

            <div class="col-md-4">
                <h3><span class="text-primary">AUTOR: </span> {{ $datosPatrimonio->autor }}</h3>
            </div>
        </div>
        <h3>&nbsp;</h3>
        <!--begin: Datatable-->
        <div class="table-responsive m-t-40">
            <table class="table table-bordered table-hover table-striped" id="tabla-raza">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Asignado</th>
                        <th>Destino</th>
                        <th>Lugar</th>
                        <th>Fecha</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movimientos as $m)
                    <tr>
                        <td>{{ $m->id }}</td>
                        <td>
                            @if ($m->asignado_id != null)
                                {{ $m->asignado->name }}
                            @endif
                        </td>
                        <td>{{ $m->destino->nombre }}</td>
                        <td>{{ $m->sitio->descripcion }} ({{ $m->sitio->sigla }})</td>
                        <td>{{ $m->fecha }}</td>
                        <td>{{ $m->observaciones }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-icon btn-danger"
                                onclick="elimina('{{ $m->id }}', '{{ $m->destino->nombre }}')">
                                <i class="flaticon2-cross"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <h3 class="text-danger">NO EXISTEN DATOS</h3>
                    @endforelse
                </tbody>
                <tbody>
                </tbody>
            </table>
        </div>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('#tabla-raza').DataTable({
            order: [[ 0, "desc" ]],
            language: {
                url: '{{ asset('datatableEs.json') }}'
            },
        });

        //cargamos a los script para select 2
        $('.seleccionadores').select2({
            placeholder: "Seleccione"
        });

    });

    	function nuevo()
    	{
			// pone los inputs vacios
			$("#id").val('');
			$("#nombre").val('');
			$("#descripcion").val('');
			// abre el modal
    		$("#modal-es").modal('show');
    	}

		function edita(id, nombre, descripcion)
    	{
			// colocamos valores en los inputs
			$("#id").val(id);
			$("#nombre").val(nombre);
			$("#descripcion").val(descripcion);

			// mostramos el modal
    		$("#modal-es").modal('show');
    	}

    	function crear()
    	{
			// verificamos que el formulario este correcto
    		if($("#formulario-movimiento")[0].checkValidity()){
				// enviamos el formulario
    			$("#formulario-movimiento").submit();
				// mostramos la alerta
				Swal.fire("Excelente!", "Registro Guardado!", "success");
    		}else{
				// de lo contrario mostramos los errores
				// del formulario
    			$("#formulario-movimiento")[0].reportValidity()
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

                    window.location.href = "{{ url('movimiento/elimina') }}/"+id;

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