@extends('adminlte::page')

@section('title', 'Nuevo Credito')

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
    		<h2>Nuevo Credito</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'credits.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}

            <div class="form-group">
                <label for="student_user_id">Estudiante: </label>
                <select style="width: 100% !important;" class="form-control super-select" name="student_user_id" id="student_user_id">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Monto: </label>
                <input type="text" class="form-control" name="amount" id="amount">
            </div>

            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('credits.index') }}" class="btn btn-danger">Cancelar</a>

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