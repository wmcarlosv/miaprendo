@extends('adminlte::page')

@section('title', 'Detalle del Credito')

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
    		<h2>Detalle del Credito</h2>
    	</div>
    	<div class="panel-body">

            <div class="form-group">
                <label for="">Estudiante: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ $credit->user->name }}" />
            </div>

            <div class="form-group">
                <label for="">Monto: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ $credit->amount }}" />
            </div>

            <div class="form-group">
                <label for="">Fecha de Agregaci&oacute;n: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ date('d-m-Y H:m:s',strtotime($credit->created_at)) }}" />
            </div>

            <a href="{{ route('credits.index') }}" class="btn btn-warning">Volver</a>

            {!! Form::close() !!}
    	</div>
    </div>
@stop