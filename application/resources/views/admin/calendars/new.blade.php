@extends('adminlte::page')

@section('title', 'Nueva Disponibilidad')

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@stop

@section('content')

    @include('flash::message')

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
                <label for="teacher_id">Profesor: </label>
                <select class="form-control super-select" style="width: 100% !important;" name="teacher_id" id="teacher_id">
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="student_id">Estudiante: </label>
                <select class="form-control super-select" style="width: 100% !important;" name="student_id" id="student_id">
                    @foreach($students as $students)
                        <option value="{{ $students->id }}">{{ $students->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="lesson_date">Fecha: </label>
                <input type="text" class="form-control date-picker" readonly="readonly" name="lesson_date" id="lesson_date">
            </div>

            <div class="form-group">
                <label for="time_from">Hora Desde: </label>
                <input type="text" readonly="readonly" class="form-control timepicker" name="time_from" id="time_from">
            </div>

            <div class="form-group">
                <label for="time_to">Hora Hasta: </label>
                <input type="text" readonly="readonly" class="form-control timepicker" name="time_to" id="time_to">
            </div>

            <div class="form-group">
                <label for="lesson_price">Cantidad de Horas: </label>
                <input type="text" class="form-control" name="lesson_price" id="lesson_price">
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.super-select').select2();
        $('input.date-picker').datepicker({
            dateFormat : 'dd-mm-yy'
        });
        $('input.timepicker').timepicker({});
    });
</script>
@stop