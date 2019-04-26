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
                <label for="">Estatus: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ $calendar->status }}" />
            </div>

            @if($calendar->status == 'revision')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Cargar las horas para esta Clase</h2>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['add_student',$calendar->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        <label for="lesson_price">Horas: </label>
                        <input class="form-control" type="text" name="lesson_price" id="lesson_price" />
                    </div>
                    <button type="submit" class="btn btn-success">Cargar Horas</button>
                    {!! Form::close() !!}
                </div>
            </div>
            @endif

            @if($calendar->status == 'aprobado' || $calendar->status == 'finalizado')
                <div class="form-group">
                <label for="">Horas: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ $calendar->lesson_price }}" />
            </div>
            @endif

            <a href="{{ route('my.lessons') }}" class="btn btn-warning">Volver</a>

    	</div>
    </div>
@stop