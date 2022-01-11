@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Nuevo Usuario</h3>
                
            </div>
            <!--begin::Form-->
            <form action="{{ url('user/guarda') }}" method="POST" id="formularioPersona">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nombres y Apellidos
                                <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ ($datosUser != null)?$datosUser->name:'' }}" required />
                                <input type="hidden" name="userId" value="{{ ($datosUser != null)?$datosUser->id:'' }}" >
                            </div>        
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Carnet
                                <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="ci" name="ci" value="{{ ($datosUser != null)?$datosUser->ci:'' }}" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email
                                <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ ($datosUser != null)?$datosUser->email:'' }}" onfocusout="validaEmail()" />
                                <span class="form-text text-danger" id="msg-error-email" style="display: none;">Correo duplicado, cambielo!!!</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Fecha Nacimiento
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ ($datosUser != null)?$datosUser->fecha_nacimiento:'' }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Direccion
                                </label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ ($datosUser != null)?$datosUser->direccion:'' }}" />
                            </div>        
                        </div>
                        
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Celulares
                                </label>
                                <input type="text" class="form-control" id="celulares" name="celulares" value="{{ ($datosUser != null)?$datosUser->celulares:'' }}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleSelect1">Perfil <span class="text-danger">*</span></label>
                                <select class="form-control" id="perfil" name="perfil" >
                                    <option value="Administrador" {{ ($datosUser != null && $datosUser->perfil == 'Administrador')?'selected':'' }}>Administrador Sistema</option>
                                    <option value="Administrativo" {{ ($datosUser != null && $datosUser->perfil == 'Administrativo')?'selected':'' }}>Administrativo</option>
                                    <option value="Direccion" {{ ($datosUser != null && $datosUser->perfil == 'Direccion')?'selected':'' }}>Direccion</option>
                                    <option value="Bibliotecario" {{ ($datosUser != null && $datosUser->perfil == 'Bibliotecario')?'selected':'' }}>Bibliotecario</option>
                                    <option value="Curador" {{ ($datosUser != null && $datosUser->perfil == 'Curador')?'selected':'' }}>Curador</option>
                                    <option value="Conservador" {{ ($datosUser != null && $datosUser->perfil == 'Conservador')?'selected':'' }}>Conservador</option>
                                    <option value="Visitante" {{ ($datosUser != null && $datosUser->perfil == 'Visitante')?'selected':'' }}>Visitante</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleSelect1">Tipo <span class="text-danger">*</span></label>
                                <select class="form-control" id="tipo" name="tipo">
                                    <option value="">Seleccione</option>
                                    <option value="Catalogador" {{ ($datosUser !=null && $datosUser->tipo == 'Catalogador')?'selected':''
                                        }}>Catalogador</option>
                                    <option value="Revisor" {{ ($datosUser !=null && $datosUser->tipo == 'Revisor')?'selected':''
                                        }}>Revisor</option>
                                    <option value="Aprobador" {{ ($datosUser !=null && $datosUser->tipo == 'Aprobador')?'selected':''
                                        }}>Aprobador</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password
                                    <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-success mr-2 btn-block" onclick="guarda()">Guardar</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('user/listado') }}" class="btn btn-secondary btn-block">Volver</a>
                        </div>
                    </div>

                </div>
                
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    
</div>

@stop

@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function guarda()
        {
            if ($("#formularioPersona")[0].checkValidity()) {

                $("#formularioPersona").submit();
                Swal.fire("Excelente!", "Se guardo el distrito!", "success");

            }else{
                $("#formularioPersona")[0].reportValidity();
            }
        }

        function edita(idUser)
        {
            window.location.href = "{{ url('user/formulario') }}/"+idUser;
        }

        function validaEmail()
        {
            let email = $("#email").val();

            $.ajax({
                url: "{{ url('user/validaEmail') }}",
                data: {email: email},
                type: 'POST',
                success: function(data) {
                    // console.log(data.vEmail);     
                    if(data.vEmail > 0){
                        $("#msg-error-email").show();
                    }else{
                        $("#msg-error-email").hide();
                    }
                }
            });
        }

    </script>
@endsection
