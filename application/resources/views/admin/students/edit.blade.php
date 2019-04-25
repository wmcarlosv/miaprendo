@extends('adminlte::page')

@section('title', 'Editar Estudiante')

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
    		<h2>Editar Estudiante</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => ['users.update','id' => $student->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
            <div class="form-group">
                <label for="name">Nombre: </label>
                <input type="text" class="form-control" value="{{ $student->name }}" name="name" id="name" />
            </div>
            <div class="form-group">
                <label for="email">Correo: </label>
                <input type="text" class="form-control" value="{{ $student->email }}" name="email" id="email" />
            </div>
            <div class="form-group">
                <label for="birthdate">Fecha de Nacimiento: </label>
                <input type="date" class="form-control" value="{{ $student->birthdate }}" name="birthdate" id="birthdate" />
            </div>
            <div class="form-group">
                <label for="address">Direcci&oacute;n: </label>
                <textarea class="form-control" name="address" id="address">{{ $student->address }}</textarea>
            </div>
            <input type="hidden" name="role" value="estudiante">
            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('students.index') }}" class="btn btn-danger">Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@stop