@extends('adminlte::page')

@section('title', 'Nueva Clase')

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
    		<h2>Nueva Clase</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'lessons.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}

            <div class="form-group">
                <label for="title">Titulo: </label>
                <input type="text" class="form-control" name="title" id="title" />
            </div>
            <div class="form-group">
                <label for="description">Descripcion: </label>
                <textarea class="form-control" name="description" id="description"></textarea>
            </div>

            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('lessons.index') }}" class="btn btn-danger">Cancelar</a>

            {!! Form::close() !!}
    	</div>
    </div>
@stop