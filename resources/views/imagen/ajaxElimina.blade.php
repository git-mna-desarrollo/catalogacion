@if ($imagenes != null)
    @foreach ($imagenes as $i)
    <div class="col-md-3">
        <img src="{{ asset("imagenes/$i->imagen") }}" class="img-fluid">
        <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_1"
            onclick="quitarImagen({{ $i->id }})">Quitar Imagen</button>
    </div>
    @endforeach
@endif