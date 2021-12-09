<div class="col-md-12">
    @if ($documentos)
    <table class="table table-striped table">
        <thead>
            <tr>
                <th>DOCUMENTOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $d)
            <tr>
                <td>
                    {{ $d->nombre }}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-sm btn-icon btn-danger"
                        onclick="mueveDocumento('{{ $d->id }}', '{{ $d->nombre }}')">
                        <i class="flaticon2-cross"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>