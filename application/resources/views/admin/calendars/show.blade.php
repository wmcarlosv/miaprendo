@extends('adminlte::page')

@section('title', 'Detalle de la Disponibilidad')

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
    		<h2>Detalle de la Disponibilidad</h2>
    	</div>
    	<div class="panel-body">

            <div class="form-group">
                <label for="">Fecha: </label>
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
                <label for="">Estatus: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ $calendar->status }}" />
            </div>

            @if(isset($calendar->student_id) and !empty($calendar->student_id))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Estudiante Asignado</h2>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>Nombre: </td>
                                <td>{{ $calendar->student->name }}</td>
                            </tr>
                            <tr>
                                <td>Email: </td>
                                <td>{{ $calendar->student->email }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
            @endif

            <a href="{{ route('calendars.index') }}" class="btn btn-warning">Volver</a>

    	</div>
    </div>
@stop