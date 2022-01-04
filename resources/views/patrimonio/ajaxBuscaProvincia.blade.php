<select name="provincia" id="provincia" class="form-control">
    @foreach ($provincias as $pro)
    <option value="{{ $pro->provincia }}">{{ $pro->provincia }}</option>                                                    
    @endforeach
</select>