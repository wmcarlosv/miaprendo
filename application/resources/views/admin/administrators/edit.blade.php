@extends('adminlte::page')

@section('title', 'Editar Administrador')

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@stop

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
    		<h2>Editar Administrador</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => ['users.update','id' => $administrator->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
            <div class="form-group">
                <label for="name">Nombre: </label>
                <input type="text" class="form-control" value="{{ $administrator->name }}" name="name" id="name" />
            </div>
            <div class="form-group">
                <label for="email">Correo: </label>
                <input type="text" class="form-control" value="{{ $administrator->email }}" name="email" id="email" />
            </div>
            <div class="form-group">
                <label for="birthdate">Fecha de Nacimiento: </label>
                <input type="text" readonly="readonly" class="form-control date-picker" value="{{ date('d-m-Y',strtotime($administrator->birthdate)) }}" name="birthdate" id="birthdate" />
            </div>
            <div class="form-group">
                <label for="address">Direcci&oacute;n: </label>
                <textarea class="form-control" name="address" id="address">{{ $administrator->address }}</textarea>
            </div>
            <input type="hidden" name="role" value="administrador">
            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('administrators.index') }}" class="btn btn-danger">Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@stop
@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input.date-picker').datepicker({
            dateFormat : 'dd-mm-yy'
        });
    });
</script>
@stop