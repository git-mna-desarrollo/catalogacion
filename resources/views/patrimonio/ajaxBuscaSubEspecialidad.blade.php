<select name="subEspecialidad" id="subEspecialidad" class="form-control">
    @foreach ($subespecialidades as $subesp)
        <option value="{{ $subesp->id }}">{{ $subesp->nombre }}</option>
    @endforeach
</select>