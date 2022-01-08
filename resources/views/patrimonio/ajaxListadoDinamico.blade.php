@if (!empty($tablaDinamica))
    <table class="table table-bordered table-hover table-striped" id="tabla-insumos">
        <thead>
            <tr>
                @foreach ($tablaDinamica as $camTab)
                    <th>{{ strtoupper($camTab) }}</th>                
                @endforeach
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patrimonios as $p)
                <tr>
                    @if(in_array("designacion nombre", $tablaDinamica))
                        <td>{{ $p->nombre }}</td>
                    @endif

                    @if(in_array("especialidad", $tablaDinamica))
                        @if ($p->especialidad_id != null)
                            <td>{{ $p->especialidad->nombre }}</td>
                        @else
                            <td></td>
                        @endif
                    @endif

                    @if(in_array("estilo", $tablaDinamica))
                        @if($p->estilo_id != null)
                            <td>{{ $p->estilo->nombre }}</td>
                        @else
                            <td></td>
                        @endif
                    @endif

                    @if(in_array("escuela", $tablaDinamica))
                        <td>{{ $p->escuela }}</td>
                    @endif

                    @if(in_array("epoca", $tablaDinamica))
                        <td>{{ $p->epoca }}</td>
                    @endif

                    @if(in_array("autor", $tablaDinamica))
                        <td>{{ $p->autor }}</td>
                    @endif

                    @if(in_array("tecnica", $tablaDinamica))
                        <td>{{ $p->tecnicas }}</td>
                    @endif

                    @if(in_array("material", $tablaDinamica))
                        <td>{{ $p->materiales }}</td>
                    @endif

                    @if(in_array("codigo", $tablaDinamica))
                        <td>{{ $p->codigo }}</td>
                    @endif

                    @if(in_array("obtencion", $tablaDinamica))
                        <td>{{ $p->obtencion }}</td>
                    @endif

                    @if(in_array("fecha adquisicion", $tablaDinamica))
                        <td>{{ $p->fecha_adquisicion }}</td>
                    @endif

                    @if(in_array("marcas", $tablaDinamica))
                        <td>{{ $p->marcas }}</td>
                    @endif

                    @if(in_array("descripcion", $tablaDinamica))
                        <td>{{ $p->descripcion }}</td>
                    @endif

                    @if(in_array("especificacion", $tablaDinamica))
                        <td>{{ $p->especificacion_conservacion }}</td>
                    @endif

                    @if(in_array("intervencion", $tablaDinamica))
                        <td>{{ $p->intervenciones_realizadas }}</td>
                    @endif

                    @if(in_array("caracteristicas tecnicas", $tablaDinamica))
                        <td>{{ $p->caracteristicas_tecnicas }}</td>
                    @endif

                    @if(in_array("caracteristicas iconograficas", $tablaDinamica))
                        <td>{{ $p->caracteristicas_iconograficas }}</td>
                    @endif

                    @if(in_array("historicos", $tablaDinamica))
                        <td>{{ $p->datos_historicos }}</td>
                    @endif

                    @if(in_array("bibliograficas", $tablaDinamica))
                        <td>{{ $p->referencias_bibliograficas }}</td>
                    @endif

                    @if(in_array("observaciones", $tablaDinamica))
                        <td>{{ $p->observaciones }}</td>
                    @endif
                    <td>
                        <a
                            href="{{ url('patrimonio/formulario', [$p->id]) }}" 
                            type="button" 
                            class="btn btn-sm btn-icon btn-warning" 
                            title="Editar">
                        <i class="flaticon2-edit"></i>
                        </a>
        
                        <a
                            href="{{ url('patrimonio/ficha')}}/{{ $p->id }}" 
                            class="btn btn-sm btn-icon btn-primary" 
                            title="Ver">
                        <i class="flaticon2-paper"></i>
                        </a>
        
                        <a 
                            href="{{ url('movimiento/listado/')}}/{{ $p->id }}" 
                            class="btn btn-sm btn-icon btn-info" 
                            title="Transferencias"
                            >
                            <i class="fas fa-arrows-alt"></i>
                        </a>
        
                        <button type="button" class="btn btn-sm btn-icon btn-danger"
                            onclick="elimina('{{ $p->id }}', '{{ $p->nombre }}')"
                            title="Eliminar">
                            <i class="flaticon2-cross"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    {{-- <h1>no</h1> --}}
    <table class="table table-bordered table-hover table-striped" id="tabla-insumos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Img</th>
                <th>COD ADM</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Autor</th>
                <th>Epoca</th>
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
                <td class="text-center">
                    @php
                        $imagen = App\imagen::where('patrimonio_id', $p->id)
                                            ->where('estado', 'Ficha')
                                            ->first();
    
                    @endphp  
                    @if ($imagen)
                    {{-- <button href="#">
                        <img src="{{ asset("imagenes/$imagen->imagen") }}" height="100" />
                    </button> --}}
    
                    <a type="button" onclick="detalle_foto('{{ $p->codigo_administrativo }}', '{{ $p->nombre }}', '{{ $p->autor }}', '{{ $p->epoca }}', '{{ ($p->especialidad_id != null)?  $p->especialidad->nombre: '' }}', '{{ ($p->estilo_id != null)?  $p->estilo->nombre: '' }}', '{{ $p->tecnicas }}', '{{ $p->materiales }}', '{{ $imagen->imagen }}')">
                        <img src="{{ asset("imagenes/$imagen->imagen") }}" height="100" />
                    </a>
                    @endif   
                </td>
                <td>{{ $p->codigo_administrativo }}</td>
                <td>{{ $p->codigo }}</td>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->autor }}</td>
                <td>{{ $p->epoca }}</td>
                <td>
                    @if ($p->especialidad_id != null)
                        {{ $p->especialidad->nombre }}
                    @endif
                </td>
                <td>
                    @if($p->estilo_id != null)
                        {{ $p->estilo->nombre }}
                    @endif
                </td>
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
                        title="Editar">
                    <i class="flaticon2-edit"></i>
                    </a>
    
                    <a
                        href="{{ url('patrimonio/ficha')}}/{{ $p->id }}" 
                        class="btn btn-sm btn-icon btn-primary" 
                        title="Ver">
                    <i class="flaticon2-paper"></i>
                    </a>
    
                    <a 
                        href="{{ url('movimiento/listado/')}}/{{ $p->id }}" 
                        class="btn btn-sm btn-icon btn-info" 
                        title="Transferencias"
                        >
                        <i class="fas fa-arrows-alt"></i>
                    </a>
    
                    <button type="button" class="btn btn-sm btn-icon btn-danger"
                        onclick="elimina('{{ $p->id }}', '{{ $p->nombre }}')"
                        title="Eliminar">
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
@endif

<script>
    // cargamos los valores del data table
    $('#tabla-insumos').DataTable({
        "searching": false,
        "lengthChange": false,
        language: {
            url: '{{ asset('datatableEs.json') }}',
        },
        order: [[ 0, "desc" ]]
    });

    function detalle_foto(codigo, nombre, autor, epoca, especialidad, estilo, tecnicas, materiales, imagen){

        // $('.codigo-admin').text(codigo);
        $('.codigo-admin').val(codigo);
        $('#inf-nombre').val(nombre);
        $('#inf-autor').val(autor);
        $('#inf-epoca').val(epoca);
        $('#inf-especialidad').val(especialidad);
        $('#inf-estilo').val(estilo);
        $('#inf-tecnicas').val(tecnicas);
        $('#inf-materiales').val(materiales);

        var url = '{{ asset("imagenes") }}/'+imagen;

        $("#mi_imagen").attr("src",url);

        $('#modal-informacion').modal('show');
    }
</script>