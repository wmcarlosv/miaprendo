@extends('adminlte::page')

@section('title', 'Estudiantes')

@section('content')
	@include('flash::message')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Estudiantes</h2>
    	</div>
    	<div class="panel-body">
    		<a href="{{ route('students.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Estudiante</a>
    		<br />
    		<br />
    		<table class="table" id="student-table">
    			<thead>
    				<th>ID</th>
    				<th>Nombre</th>
    				<th>Correo</th>
    				<th>Fecha Nacimiento</th>
                    <th>Direcci&oacute;n</th>
    				<th>-</th>
    			</thead>
    			<tbody>
    				@foreach($students as $student)
    				<tr>
    					<td>{{ $student->id }}</td>
    					<td>{{ $student->name }}</td>
    					<td>{{ $student->email }}</td>
    					<td>{{ date('d-m-Y',strtotime($student->birthdate)) }}</td>
                        <td>{{ $student->address }}</td>
    					<td>
    						<a class="btn btn-info" href="{{ route('users.edit',['id' => $student->id]) }}"><i class="fa fa-pencil"></i></a>
    						{!! Form::open(['route' => ['users.destroy',$student->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
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
		$("#student-table").DataTable();
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

		$("button.delete-record").click(function(){
			if(!confirm("Estas seguro de eliminar este Estudiante?")){
				return false;
			}
		});
	})
</script>
@stop