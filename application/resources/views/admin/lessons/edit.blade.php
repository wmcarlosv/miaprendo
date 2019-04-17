@extends('adminlte::page')

@section('title', 'Editar Clase')

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
    		<h2>Editar Clase</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => ['lessons.update',$lesson->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}

            <div class="form-group">
                <label for="title">Titulo: </label>
                <input type="text" class="form-control" value="{{ $lesson->title }}" name="title" id="title" />
            </div>
            <div class="form-group">
                <label for="description">Descripcion: </label>
                <textarea class="form-control" name="description" id="description">{{ $lesson->description }}</textarea>
            </div>

            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('lessons.index') }}" class="btn btn-danger">Cancelar</a>

            {!! Form::close() !!}
    	</div>
    </div>
@stop