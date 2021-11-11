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
            <table class="table table-bordered">
                <tr>
                    <td>
                        <h5 class="font-weight-boldest">01 LOCALIDAD</h5>
                        <p class="font-size-h6">{{ $patrimonio->localidad }}</p>
                    </td>
                    <td colspan="2">
                        <h5 class="font-weight-boldest">08 DESIGNACION / NOMBRE</h5>
                        <p class="font-size-h6">{{ $patrimonio->nombre }}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h5 class="font-weight-boldest">02 PROVINCIA</h5>
                        <p class="font-size-h6">{{ $patrimonio->provincia }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">09 ESPECIALIDAD</h5>
                        <p class="font-size-h6">{{ $patrimonio->especialidad->nombre }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">15 No. INVENTARIO</h5>
                        <p class="font-size-h6">{{ $patrimonio->inventario }}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h5 class="font-weight-boldest">03 DEPARTAMENTO</h5>
                        <p class="font-size-h6">{{ $patrimonio->provincia }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">10 ESTILO</h5>
                        <p class="font-size-h6">{{ $patrimonio->estilo->nombre }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">16 CODIGO</h5>
                        <p class="font-size-h6">{{ $patrimonio->codigo }}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h5 class="font-weight-boldest">04 INMUEBLE</h5>
                        <p class="font-size-h6">{{ $patrimonio->inmueble }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">11 ESCUELA</h5>
                        <p class="font-size-h6">{{ $patrimonio->escuela }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">17 No. </h5>
                        <p class="font-size-h6">{{ $patrimonio->codigo }}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h5 class="font-weight-boldest">05 CALLE/No</h5>
                        <p class="font-size-h6">{{ $patrimonio->calle }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">12 EPOCA Y/O FECHA</h5>
                        <p class="font-size-h6">{{ $patrimonio->epoca }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">18 ORIGEN </h5>
                        <p class="font-size-h6">{{ $patrimonio->codigo }}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h5 class="font-weight-boldest">06 UBICACION EN EL INMUEBLE</h5>
                        <p class="font-size-h6">{{ $patrimonio->calle }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">13 AUTOR / ATRIBUCION</h5>
                        <p class="font-size-h6">{{ $patrimonio->autor }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">19 OBTENCION </h5>
                        <p class="font-size-h6">{{ $patrimonio->obtencion }}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h5 class="font-weight-boldest">07 RESPONSABLE</h5>
                        <p class="font-size-h6">{{ $patrimonio->calle }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">14 TECNICA Y MATERIAL</h5>
                        <p class="font-size-h6">{{ $patrimonio->tecnicamaterial->nombre }}</p>
                    </td>
                    <td>
                        <h5 class="font-weight-boldest">20 FECHA ADQUISICION </h5>
                        <p class="font-size-h6">{{ $patrimonio->fecha_adquisicion_texto }}</p>
                    </td>
                </tr>

            </table>            

            <table class="table table-bordered">
                <tr>
                    <td style="width: 50%;">
                        IMAGEN

                        <h5 class="font-weight-boldest">25 PROTECCION LEGAL</h5>
                        <p class="font-size-h6">
                        @php
                            $estado = App\Estado::where('patrimonio_id', $patrimonio->id)
                                                    ->first();
                        @endphp
                        <table class="table-borderless">
                            <tr>
                                <td>MONUMENTO NACIONAL </td>
                                <td>
                                    @if ($estado->monumento_nacional == 'Si')
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" checked="checked" />
                                            <span></span>
                                        
                                        </label>                                        
                                    @else
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" />
                                            <span></span>
                                    
                                        </label>                                        
                                    @endif
                                </td>
                                <td style="padding-left: 60px;">INDIVIDUAL</td>
                                <td>
                                    @if ($estado->individual == 'Si')
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" checked="checked" />
                                            <span></span>
                                        
                                        </label>
                                    @else
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" />
                                            <span></span>
                                        
                                        </label>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>RESOLUCION MUNICIPAL </td>
                                <td>
                                    @if ($estado->resolucion_municipal == 'Si')
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" checked="checked" />
                                            <span></span>
                                        
                                        </label>
                                    @else
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" />
                                            <span></span>
                                        
                                        </label>
                                    @endif

                                </td>
                                <td style="padding-left: 60px;">DE CONJUNTO</td>
                                <td>
                                    @if ($estado->conjunto == 'Si')
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" checked="checked" />
                                            <span></span>
                                        
                                        </label>
                                    @else
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" />
                                            <span></span>
                                        
                                        </label>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>RESOL. ADM.</td>
                                <td>
                                    @if ($estado->resolucion_administrativa == 'Si')
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" checked="checked" />
                                            <span></span>
                                        
                                        </label>
                                    @else
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" />
                                            <span></span>
                                        
                                        </label>
                                    @endif
                                </td>
                                <td style="padding-left: 60px;">NINGUNA</td>
                                <td>
                                    @if ($estado->ninguna == 'Si')
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" checked="checked" />
                                            <span></span>
                                        
                                        </label>
                                    @else
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="Checkboxes16" />
                                            <span></span>
                                        
                                        </label>
                                    @endif

                                </td>
                            </tr>
                            
                        </table>
                        </p>
                        <hr />

                        <h5 class="font-weight-boldest">26 ESTADO DE CONSERVACION</h5>
                        <p class="font-size-h6">
                        <table class="table-borderless">
                            <tr>
                                <td>EXCELENTE </td>
                                <td>
                                    @if ($estado->estado_conservacion == 'Excelente')
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" checked="checked" />
                                        <span></span>
                        
                                    </label>
                                    @else
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" />
                                        <span></span>
                        
                                    </label>
                                    @endif
                                </td>

                                <td>BUENO </td>
                                <td>
                                    @if ($estado->estado_conservacion == 'Bueno')
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" checked="checked" />
                                        <span></span>
                        
                                    </label>
                                    @else
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" />
                                        <span></span>
                        
                                    </label>
                                    @endif
                                </td>

                                <td>REGULAR </td>
                                <td>
                                    @if ($estado->estado_conservacion == 'Regular')
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" checked="checked" />
                                        <span></span>
                        
                                    </label>
                                    @else
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" />
                                        <span></span>
                        
                                    </label>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>MALO </td>
                                <td>
                                    @if ($estado->estado_conservacion == 'Malo')
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" checked="checked" />
                                        <span></span>
                            
                                    </label>
                                    @else
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" />
                                        <span></span>
                            
                                    </label>
                                    @endif
                                </td>
                            
                                <td>PESIMO </td>
                                <td>
                                    @if ($estado->estado_conservacion == 'Pesimo')
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" checked="checked" />
                                        <span></span>
                            
                                    </label>
                                    @else
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" />
                                        <span></span>
                            
                                    </label>
                                    @endif
                                </td>
                            
                                <td>FRAGMENTO </td>
                                <td>
                                    @if ($estado->estado_conservacion == 'Fragmento')
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" checked="checked" />
                                        <span></span>
                            
                                    </label>
                                    @else
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" />
                                        <span></span>
                            
                                    </label>
                                    @endif
                                </td>
                            </tr>

                        </table>
                        </p>
                        <hr />

                        <h5 class="font-weight-boldest">27 CONDICIONES DE SEGURIDAD</h5>
                        <p class="font-size-h6">
                        <table class="table-borderless">
                            <tr>
                                <td>BUENA </td>
                                <td>
                                    @if ($estado->condiciones_seguridad == 'Buena')
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" checked="checked" />
                                        <span></span>
                        
                                    </label>
                                    @else
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" />
                                        <span></span>
                        
                                    </label>
                                    @endif
                                </td>
                        
                                <td>RAZONABLE </td>
                                <td>
                                    @if ($estado->condiciones_seguridad == 'Razonable')
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" checked="checked" />
                                        <span></span>
                        
                                    </label>
                                    @else
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" />
                                        <span></span>
                        
                                    </label>
                                    @endif
                                </td>
                        
                                <td>NINGUNA </td>
                                <td>
                                    @if ($estado->condiciones_seguridad == 'Ninguna')
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" checked="checked" />
                                        <span></span>
                        
                                    </label>
                                    @else
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                        <input type="checkbox" name="Checkboxes16" />
                                        <span></span>
                        
                                    </label>
                                    @endif
                                </td>
                            </tr>
                        
                        </table>
                        </p>

                    </td>
                    <td>
                        <h5 class="font-weight-boldest">21 MARCAS / INSCRIPCIONES</h5>
                        <p class="font-size-h6">{{ $patrimonio->tecnicamaterial->nombre }}</p>
                        <hr />

                        <h5 class="font-weight-boldest">22 DIMENCIONES</h5>
                        <p class="font-size-h6">
                            <table class="table-borderless">
                                <tr>
                                    <td>ALTO </td>
                                    <td>{{ $patrimonio->alto }}</td>
                                    <td style="padding-left: 60px;">LARGO </td>
                                    <td>{{ $patrimonio->largo }}</td>
                                </tr>
                                <tr>
                                    <td>ANCHO  </td>
                                    <td>{{ $patrimonio->ancho }}</td>
                                    <td style="padding-left: 60px;">PROFUNDIDAD </td>
                                    <td>{{ $patrimonio->profundidad }}</td>
                                </tr>
                                <tr>
                                    <td>DIAMETRO  </td>
                                    <td>{{ $patrimonio->diametro }}</td>
                                    <td style="padding-left: 60px;">PESO </td>
                                    <td>{{ $patrimonio->peso }}</td>
                                </tr>
                                <tr>
                                    <td>CIRCUNFERENCIA  </td>
                                    <td>{{ $patrimonio->circunferencia }}</td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </table>
                        </p>
                        <hr />

                        <h5 class="font-weight-boldest">23 DESCRIPCION</h5>
                        <p class="font-size-h6">{{ $patrimonio->descripcion }}</p>
                        <hr />

                        <h5 class="font-weight-boldest">24 ARCHIVO FOTOGRAFICO</h5>
                        <p class="font-size-h6">
                        <table class="table-borderless">
                            <tr>
                                <td>No. DE ROLLO </td>
                                <td>{{ $patrimonio->rollo }}</td>
                                <td style="padding-left: 60px;">No. DE TOMA</td>
                                <td>{{ $patrimonio->toma }}</td>
                            </tr>
                            <tr>
                                <td>FOTOGRAFO </td>
                                <td>{{ $patrimonio->fotografo }}</td>
                                <td style="padding-left: 60px;"> </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>FECHA </td>
                                <td>{{ $patrimonio->fecha_fotografia }}</td>
                                <td style="padding-left: 60px;"> </td>
                                <td></td>
                            </tr>
                            
                        </table>
                        </p>
                        <hr />

                    </td>
                </tr>
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