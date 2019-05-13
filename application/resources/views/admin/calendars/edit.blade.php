@extends('adminlte::page')

@section('title', 'Editar Disponibilidad')

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
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
    		<h2>Editar Disponibilidad</h2>
    	</div>
    	<div class="panel-body">
            {!! Form::open(['route' => ['calendars.update',$calendar->id], 'method' => 'PUT']) !!}
            <div class="form-group">
                <label for="lesson_date">Fecha: </label>
                <input type="text" readonly="readonly" class="form-control date-picker" value="{{ date('d-m-Y', strtotime($calendar->lesson_date)) }}" name="lesson_date" id="lesson_date" />
            </div>

            <div class="form-group">
                <label for="">Hora Desde: </label>
                <input type="time" name="time_from" id="time_from" class="form-control" value="{{ $calendar->time_from }}" />
            </div>

            <div class="form-group">
                <label for="">Hora Hasta: </label>
                <input type="time" name="time_to" id="time_to" class="form-control" value="{{ $calendar->time_to }}" />
            </div>

            <div class="form-group">
                <label for="">Clase: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ $calendar->lesson->title }}" />
            </div>

            <div class="form-group">
                <label for="">Cantidad de Horas: </label>
                <input type="text" class="form-control" name="lesson_price" id="lesson_price" value="{{ $calendar->lesson_price }}" />
            </div>

            <div class="form-group">
                <label for="">Estudiante: </label>
                @if(isset($calendar->student_id) and !empty($calendar->student_id))
                    <input type="text" readonly="readonly" class="form-control" value="{{ $calendar->student->name }}" />
                @else
                    <input type="text" readonly="readonly" class="form-control" value="Sin Asignar" />
                @endif
                <input type="hidden" name="student_asigned_id" value="{{ $calendar->student_id }}">
            </div>
            @if(Auth::user()->role == 'administrador')
                <div class="form-group">
                    <label for="status">Estatus: </label>
                    <select class="form-control" name="status" id="status">
                        <option value="revision" @if($calendar->status == 'revision') selected @endif>Revision</option>
                        <option value="aprobado" @if($calendar->status == 'aprobado') selected @endif>Aprobado</option>
                        <option value="rechazado" @if($calendar->status == 'rechazado') selected @endif>Rechazado</option>
                        <option value="finalizado" @if($calendar->status == 'finalizado') selected @endif>Finalizado</option>
                    </select>
                </div>
            @endif
            @if(isset($calendar->document) and !empty($calendar->document))
                <div class="form-group">
                    <label for="">Observaci&oacute;n: </label>
                    <textarea readonly="readonly" class="form-control">{{ $calendar->observation }}</textarea>
                </div>
                <a class="btn btn-success" href="{{ asset('application/storage/app/'.$calendar->document) }}" target="_blank"><i class="fa fa-download"></i> Descargar Archivo</a>
                <br />
                <br />
            @endif
            <button type="submit" class="btn btn-success">Guardar</button>
            @if(Auth::user()->role == 'administrador')
                <a href="{{ route('repeat.calendar',$calendar->id) }}" class="btn btn-info">Repetir Clase</a>
            @endif
            <a href="{{ route('home') }}" class="btn btn-warning">Volver</a>

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