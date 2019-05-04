@extends('adminlte::page')

@section('title', 'Horas Trabajadas Profesores')

@section('content')
	@include('flash::message')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Horas Trabajadas Profesores</h2>
    	</div>
    	<div class="panel-body">

    		<table class="table" id="hours-table">
    			<thead>
    				<th>Profesor</th>
                    <th>Mes/A&ntilde;o</th>
                    <th>Horas Acomularas</th>
    			</thead>
    			<tbody>
    				@foreach($hours as $h)
                        <tr>
                            <td>{{ $h->teacher }}</td>
                            <td>{{ $h->ldate }}</td>
                            <td>{{ $h->hours }}</td>
                        </tr>
                    @endforeach
    			</tbody>
    		</table>
    	</div>
    </div>
@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $("#hours-table").DataTable();
    });
</script>
@stop