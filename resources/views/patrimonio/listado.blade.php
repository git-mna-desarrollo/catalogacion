@extends('layouts.app')

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
            <a href="{{ url('patrimonio/formulario') }}" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
                <i class="fa fa-plus-square"></i> NUEVO PATRIMONIO
            </a>
            <!--end::Button-->
        </div>
    </div>

    <div class="card-body">
        <!--begin: Datatable-->
        <div class="table-responsive m-t-40">
            <form action="">
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
                            <label for="exampleInputPassword1">Nombre </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" />
                        </div>
                    </div>

                    
                </div>
            </form>

            <table class="table table-bordered table-hover table-striped" id="tabla-insumos">
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
                            <button 
                                type="button" 
                                class="btn btn-sm btn-icon btn-warning" 
                                onclick="edita('{{ $p->id }}'">
                            <i class="flaticon2-edit"></i>
                            </button>

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
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript">
    $(function () {
    	    $('#tabla-insumos').DataTable({
                "searching": false,
                "lengthChange": false,
    	        language: {
    	            url: '{{ asset('datatableEs.json') }}',
    	        },
				order: [[ 0, "desc" ]]
    	    });

    	});

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