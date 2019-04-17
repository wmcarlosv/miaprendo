@extends('adminlte::page')

@section('title', 'Nuevo Profesor')

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Nuevo Profesor</h2>
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
            <div class="input-group">
                <input type="text" class="form-control" readonly="readonly" name="password" id="password" placeholder="Contraseña">
                <div class="input-group-btn">
                  <button class="btn btn-info" type="button">
                    Generar
                  </button>
                </div>
            </div>
            <input type="hidden" name="role" value="profesor">
            <br />
            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-danger">Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@stop