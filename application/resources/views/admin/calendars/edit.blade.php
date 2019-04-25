@extends('adminlte::page')

@section('title', 'Editar Disponibilidad')

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
    		<h2>Editar Disponibilidad</h2>
    	</div>
    	<div class="panel-body">
            {!! Form::open(['route' => ['calendars.update',$calendar->id], 'method' => 'PUT']) !!}
            <div class="form-group">
                <label for="lesson_date">Fecha: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ date('d-m-Y', strtotime($calendar->lesson_date)) }}" />
            </div>

            <div class="form-group">
                <label for="">Hora Desde: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ $calendar->time_from }}" />
            </div>

            <div class="form-group">
                <label for="">Hora Hasta: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ $calendar->time_to }}" />
            </div>

            <div class="form-group">
                <label for="">Clase: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ $calendar->lesson->title }}" />
            </div>

            <div class="form-group">
                <label for="">Cantidad de Horas: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ $calendar->lesson_price }}" />
            </div>

            <div class="form-group">
                <label for="student_id">Estudiante: </label>
                <select class="form-control super-select" style="width: 100% !important;" name="student_id" id="student_id">
                    <option>-</option>
                    @foreach($students as $student)
                        @if($student->id == $calendar->student_id)
                            <option value="{{ $student->id }}" selected="selected">{{ $student->name }}</option>
                        @else
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endif
                    @endforeach()
                </select>
            </div>

            <div class="form-group">
                <label for="status">Estatus: </label>
                <select class="form-control" name="status" id="status">
                    <option value="revision" @if($calendar->status == 'revision') selected @endif>Revision</option>
                    <option value="aprobado" @if($calendar->status == 'aprobado') selected @endif>Aprobado</option>
                    <option value="rechazado" @if($calendar->status == 'rechazado') selected @endif>Rechazado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('home') }}" class="btn btn-warning">Volver</a>

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