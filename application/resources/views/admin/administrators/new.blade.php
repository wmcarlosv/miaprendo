@extends('adminlte::page')

@section('title', 'Nuevo Administrador')

@section('content')
    <!--Show Errors-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--End Show Errors-->
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Nuevo Administrador</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'users.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
            <div class="form-group">
                <label for="name">Nombre: </label>
                <input type="text" class="form-control" name="name" id="name" />
            </div>
            <div class="form-group">
                <label for="email">Correo: </label>
                <input type="text" class="form-control" name="email" id="email" />
            </div>
            <div class="form-group">
                <label for="birthdate">Fecha de Nacimiento: </label>
                <input type="date" class="form-control" name="birthdate" id="birthdate" />
            </div>
            <div class="form-group">
                <label for="address">Direcci&oacute;n: </label>
                <textarea class="form-control" name="address" id="address"></textarea>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" readonly="readonly" name="password" id="password" placeholder="Contraseña">
                <div class="input-group-btn">
                  <button class="btn btn-info" id="generate-password" type="button">
                    Generar
                  </button>
                </div>
            </div>
            <input type="hidden" name="role" value="administrador">
            <br />
            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('administrators.index') }}" class="btn btn-danger">Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@stop
@section('js')
<script type="text/javascript">
    function randomPassword(length) {
        var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }
        return pass;
    }

    $(document).ready(function(){
        $("#generate-password").click(function(){
            var pass = randomPassword(8);

            $("#password").val(pass);
        });
    });
</script>
@stop