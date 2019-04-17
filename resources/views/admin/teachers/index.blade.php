@extends('adminlte::page')

@section('title', 'Profesores')

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Profesores</h2>
    	</div>
    	<div class="panel-body">
    		<a href="{{ route('teachers.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Profesor</a>
    		<br />
    		<br />
    		<table class="table" id="teacher-table">
    			<thead>
    				<th>ID</th>
    				<th>Nombre</th>
    				<th>Correo</th>
    				<th>Fecha Nacimiento</th>
    				<th>-</th>
    			</thead>
    			<tbody>
    				@foreach($teachers as $teacher)
    				<tr>
    					<td>{{ $teacher->id }}</td>
    					<td>{{ $teacher->name }}</td>
    					<td>{{ $teacher->email }}</td>
    					<td>{{ $teacher->birthdate }}</td>
    					<td></td>
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
		$("#teacher-table").DataTable();
	})
</script>
@stop