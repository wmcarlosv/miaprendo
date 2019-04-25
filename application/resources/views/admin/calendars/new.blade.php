@extends('adminlte::page')

@section('title', 'Nueva Disponibilidad')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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
    		<h2>Nueva Disponibilidad</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'calendars.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}

            <div class="form-group">
                <label for="lesson_date">Fecha: </label>
                <input type="date" class="form-control" name="lesson_date" id="lesson_date">
            </div>

            <div class="form-group">
                <label for="time_from">Hora Desde: </label>
                <input type="time" class="form-control" name="time_from" id="time_from">
            </div>

            <div class="form-group">
                <label for="time_to">Hora Hasta: </label>
                <input type="time" class="form-control" name="time_to" id="time_to">
            </div>

            <div class="form-group">
                <label for="lesson_id">Clase: </label>
                <select class="form-control super-select" style="width: 100% !important;" name="lesson_id" id="lesson_id">
                    @foreach($lessons as $lesson)
                        <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('calendars.index') }}" class="btn btn-danger">Cancelar</a>

            {!! Form::close() !!}
    	</div>
    </div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.super-select').select2();
    });
</script>
@stop