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
                    $imagen = App\Imagen::where('patrimonio_id', $p->id)
                                        ->where('estado', 'Ficha')
                                        ->first();
                    dd($imagen);
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

                <a 
                    href="{{ url('patrimonio/listaLog/')}}/{{ $p->id }}" 
                    class="btn btn-sm btn-icon btn-dark" 
                    title="Transferencias"
                    >
                    <i class="fas fa-list-ol"></i>
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