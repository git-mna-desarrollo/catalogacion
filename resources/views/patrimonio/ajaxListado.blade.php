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
                    <img src="{{ asset("imagenes/$imagen->imagen") }}" height="100" />
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
</script>