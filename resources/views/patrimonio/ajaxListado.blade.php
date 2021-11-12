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