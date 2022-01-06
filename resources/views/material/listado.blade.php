
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
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE MATERIALES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('material/guarda') }}" method="POST" id="formulario-tipos">
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nombre
                                    <span class="text-danger">*</span></label>
                                <input type="hidden" class="text" id="material_id" name="material_id" value="0" />
                                <input type="text" class="form-control" id="nombre" name="nombre" required />
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
            <h3 class="card-label">MATERIALES
            </h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
                <i class="fa fa-plus-square"></i> NUEVA MATERIAL
            </a>
            <!--end::Button-->
        </div>
    </div>

    <div class="card-body"> 
        <!--begin: Datatable-->
        <div class="table-responsive m-t-40">
            <table class="table table-bordered table-hover table-striped" id="tabla-raza">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materiales as $mate)
                    <tr>
                        <td style="width: 5%">{{ $mate->id }}</td>
                        <td>{{ $mate->nombre }}</td>
                        <td style="width: 10%">
                            <button type="button" class="btn btn-sm btn-icon btn-warning"
                                onclick="edita('{{ $mate->id }}', '{{ $mate->nombre }}')">
                                <i class="flaticon2-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-danger"
                                onclick="elimina('{{ $mate->id }}', '{{ $mate->nombre }}')">
                                <i class="flaticon2-trash"></i>
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
    	});

    	function nuevo()
    	{
			// pone los inputs vacios
			$("#material_id").val('0');
			$("#nombre").val('');
			// abre el modal
    		$("#modal-es").modal('show');
    	}

		function edita(id,nombre)
    	{
			// colocamos valores en los inputs
			$("#material_id").val(id);
			$("#nombre").val(nombre);

			// mostramos el modal
    		$("#modal-es").modal('show');
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

                    window.location.href = "{{ url('material/elimina') }}/"+id;

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