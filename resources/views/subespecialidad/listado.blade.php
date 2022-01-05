
@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')


{{-- inicio modal subespecialidad --}}

<div class="modal fade" id="modal-subes" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE ADICIONAR SUB ESPECIALIDAD A LA ESPECIALIDAD (<span class="text-danger">{{ $especialidad->nombre }}</span>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('subespecialidad/guarda') }}" method="POST" id="formulario-tipos">
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nombre
                                    <span class="text-danger">*</span></label>
                                <input type="hidden" class="" id="subesp_id" name="subesp_id" value="{{ $especialidad->id }}" />
                                <input type="text" class="form-control" id="subesp_nombre" name="subesp_nombre" required />
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Descripcion
                                    <span class="text-danger">*</span></label>
                                <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
                            </div>
                        </div> --}}
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
{{-- fin  modal sub especialidad--}}


<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">SUB ESPECIALIDADES DE LA ESPECIALIDAD (<span class="text-danger">{{ $especialidad->nombre }}</span>)
            </h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
                <i class="fa fa-plus-square"></i> NUEVA SUB ESPECIALIDAD
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
                        {{-- <th>Descripcion</th> --}}
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subespecialidades as $subesp)
                    <tr>
                        <td style="width: 5%">{{ $subesp->id }}</td>
                        <td style="width: 30%">{{ $subesp->nombre }}</td>
                        {{-- <td style="width: 40%">{{ $subesp->descripcion }}</td> --}}
                        <td style="width: 10%">
                            <button type="button" class="btn btn-sm btn-icon btn-danger"
                                onclick="elimina('{{ $subesp->id }}', '{{ $subesp->nombre }}')">
                                <i class="flaticon2-cross"></i>
                            </button>
                            {{-- <button type="button" class="btn btn-sm btn-icon btn-warning"
                                onclick="edita('{{ $subesp->id }}', '{{ $subesp->nombre }}', '{{ $subesp->descripcion }}')">
                                <i class="flaticon2-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-success"
                                onclick="addSubEsp('{{ $subesp->id }}', '{{ $subesp->nombre }}')">
                                <i class="flaticon2-add"></i>
                            </button>
                            @php
                                $patrimonios = App\Patrimonio::where('especialidad_id', $subesp->id)
                                                            ->first();
                            @endphp
                            @if ($patrimonios == null)
                                <button type="button" class="btn btn-sm btn-icon btn-danger"
                                    onclick="elimina('{{ $subesp->id }}', '{{ $subesp->nombre }}')">
                                    <i class="flaticon2-cross"></i>
                                </button>
                            @endif --}}
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
				order: [[ 1, "asc" ]],
				language: {
					url: '{{ asset('datatableEs.json') }}'
				},
			});
    	});

    	function nuevo()
    	{
			// pone los inputs vacios
			$("#id").val('');
			$("#nombre").val('');
			$("#descripcion").val('');
			// abre el modal
    		$("#modal-subes").modal('show');
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

                    window.location.href = "{{ url('subespecialidad/elimina') }}/"+id;

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