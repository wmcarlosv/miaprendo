@extends('adminlte::page')

@section('title', 'Editar Profesor')

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Editar Profesor</h2>
    	</div>

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

    	<div class="panel-body">
    		{!! Form::open(['route' => ['users.update','id' => $teacher->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
            <div class="form-group">
                <label for="name">Nombre: </label>
                <input type="text" class="form-control" value="{{ $teacher->name }}" name="name" id="name" />
            </div>
            <div class="form-group">
                <label for="email">Correo: </label>
                <input type="text" class="form-control" value="{{ $teacher->email }}" name="email" id="email" />
            </div>
            <div class="form-group">
                <label for="birthdate">Fecha de Nacimiento: </label>
                <input type="date" class="form-control" value="{{ $teacher->birthdate }}" name="birthdate" id="birthdate" />
            </div>
            <input type="hidden" name="role" value="profesor">
            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-danger">Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@stop