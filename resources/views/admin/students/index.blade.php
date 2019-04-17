@extends('adminlte::page')

@section('title', 'Profesores')

@section('content')
	@include('flash::message')
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
    					<td>{{ date('d-m-Y',strtotime($teacher->birthdate)) }}</td>
    					<td>
    						<a class="btn btn-info" href="{{ route('users.edit',['id' => $teacher->id]) }}"><i class="fa fa-pencil"></i></a>
    						{!! Form::open(['route' => ['users.destroy',$teacher->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
    							<button class="btn btn-danger delete-record" type="submit"><i class="fa fa-times"></i></button>
    						{!! Form::close() !!}
    					</td>
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
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

		$("button.delete-record").click(function(){
			if(!confirm("Estas seguro de eliminar este Profesor?")){
				return false;
			}
		});
	})
</script>
@stop