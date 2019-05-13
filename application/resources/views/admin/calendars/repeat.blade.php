@extends('adminlte::page')

@section('title', 'Repetir Clase')

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    		<h2>Repetir Clase</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'calendars.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}

            <div class="form-group">
                <label for="teacher_id">Profesor: </label>
                <input type="text" class="form-control" readonly="readonly" value="{{ $calendar->teacher->name }}">
                <input type="hidden" name="teacher_id" value="{{ $calendar->teacher_id }}">
            </div>

            <div class="form-group">
                <label for="student_id">Estudiante: </label>
                <input type="text" class="form-control" readonly="readonly" value="{{ $calendar->student->name }}">
                <input type="hidden" name="student_id" value="{{ $calendar->student_id }}">
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
                <select name="lesson_price" class="form-control" id="lesson_price">
                    @for($i=1;$i < 13; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="lesson_id">Clase: </label>
                <input type="text" class="form-control" readonly="readonly" value="{{ $calendar->lesson->title }}">
                <input type="hidden" name="lesson_id" value="{{ $calendar->lesson_id }}">
            </div>

            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('list.calendars') }}" class="btn btn-danger">Cancelar</a>

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
        $('input.timepicker').timepicker({
            timeFormat: 'h:mm p',
            defaultTime: '24'
        });

        $("#student_id").val('{{ $calendar->student_id }}');
        $("#teacher_id").val('{{ $calendar->teacher_id }}');
        $("#lesson_id").val('{{ $calendar->lesson_id }}');
    });
</script>
@stop