
@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')


<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">LISTA DE CAMBIOS DEL PATRIMONIO <span class="text-danger"> {{ $patrimonio->nombre }}</span>
            </h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ url("patrimonio/impresion/$patrimonio->id") }}" target="_blank" class="btn btn-primary font-weight-bolder">GENERAR AFICHE</a>
        </div>
    </div>

    <div class="card-body">
        <!--begin: Datatable-->
        <div class="table-responsive m-t-40">
            <table class="table table-bordered table-hover table-striped" id="tabla-raza">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patrimonio</th>
                        <th>Campo</th>
                        <th>Dato Anterior</th>
                        <th>Dato Modificado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($modificaciones as $modi)
                    <tr>
                        <td style="width: 5%">{{ $modi->id }}</td>
                        <td>{{ $modi->patrimonio->nombre }}</td>
                        <td>{{ $modi->campo }}</td>
                        <td>
                        @php
                            if(is_numeric($modi->dato_anterior)){
                                $campoAnteriror = '';
                                switch ($modi->campo) {
                                    case 'UBICACION':
                                        $ubicacion = App\Ubicacion::find($modi->dato_anterior);
                                        if($ubicacion){
                                            $campoAnteriror = $ubicacion->nombre;
                                        }
                                        break;

                                    case 'RESPONSABLE':
                                        $respnsable = App\Users::find($modi->dato_anterior);
                                        if($respnsable){
                                            $campoAnteriror = $respnsable->name;
                                        }
                                        break;

                                    case 'ESPECIALIDAD':
                                        $especialidad = App\Especialidad::find($modi->dato_anterior);
                                        if($especialidad){
                                            $campoAnteriror = $especialidad->nombre;
                                        }
                                        break;

                                    case 'SUB ESPECIALIDAD':
                                        $subespecialidad = App\SubEspecialidad::find($modi->dato_anterior);
                                        if($subespecialidad){
                                            $campoAnteriror = $subespecialidad->nombre;
                                        }
                                        break;

                                    case 'ESTILO':
                                        $estilo = App\Estilo::find($modi->dato_anterior);
                                        if($estilo){
                                            $campoAnteriror = $estilo->nombre;
                                        }
                                        break;

                                    case 'TECNICA MATERIAL':
                                        $tecnicaMaterial = App\Tecnicamaterial::find($modi->dato_anterior);
                                        if($tecnicaMaterial){
                                            $campoAnteriror = $tecnicaMaterial->nombre;
                                        }
                                        break;

                                    case 'CUENTA':
                                        $cuenta = App\Cuenta::find($modi->dato_anterior);
                                        if($cuenta){
                                            $campoAnteriror = $cuenta->nombre;
                                        }
                                        break;
                                    
                                    default:
                                        $campoAnteriror = '';
                                        break;
                                }
                                echo $campoAnteriror;
                            }else{
                                echo $modi->dato_anterior;
                            }
                        @endphp    
                        </td>
                        <td>
                        @php
                            if(is_numeric($modi->dato_modificado)){
                                $campoModificado = '';
                                switch ($modi->campo) {
                                    case 'UBICACION':
                                        $ubicacion = App\Ubicacion::find($modi->dato_modificado);
                                        if($ubicacion){
                                            $campoModificado = $ubicacion->nombre;
                                        }
                                        break;

                                    case 'RESPONSABLE':
                                        $respnsable = App\Users::find($modi->dato_modificado);
                                        if($respnsable){
                                            $campoModificado = $respnsable->name;
                                        }
                                        break;

                                    case 'ESPECIALIDAD':
                                        $especialidad = App\Especialidad::find($modi->dato_modificado);
                                        if($especialidad){
                                            $campoModificado = $especialidad->nombre;
                                        }
                                        break;

                                    case 'SUB ESPECIALIDAD':
                                        $subespecialidad = App\SubEspecialidad::find($modi->dato_modificado);
                                        if($subespecialidad){
                                            $campoModificado = $subespecialidad->nombre;
                                        }
                                        break;

                                    case 'ESTILO':
                                        $estilo = App\Estilo::find($modi->dato_modificado);
                                        if($estilo){
                                            $campoModificado = $estilo->nombre;
                                        }
                                        break;

                                    case 'TECNICA MATERIAL':
                                        $tecnicaMaterial = App\Tecnicamaterial::find($modi->dato_modificado);
                                        if($tecnicaMaterial){
                                            $campoModificado = $tecnicaMaterial->nombre;
                                        }
                                        break;

                                    case 'CUENTA':
                                        $cuenta = App\Cuenta::find($modi->dato_modificado);
                                        if($cuenta){
                                            $campoModificado = $cuenta->nombre;
                                        }
                                        break;
                                    
                                    default:
                                        $campoModificado = '';
                                        break;
                                }
                                echo $campoModificado;
                            }else{
                                echo $modi->dato_modificado;
                            }
                        @endphp    
                        </td>
                        <td>{{ $modi->created_at }}</td>
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


</script>
@endsection