@extends('adminlte::page')

@section('title', 'Administradores')

@section('content')
	@include('flash::message')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Administradores</h2>
    	</div>
    	<div class="panel-body">
    		<a href="{{ route('administrators.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Administrador</a>
    		<br />
    		<br />
    		<table class="table" id="administrator-table">
    			<thead>
    				<th>ID</th>
    				<th>Nombre</th>
    				<th>Correo</th>
    				<th>Fecha Nacimiento</th>
                    <th>Direcci&oacute;n</th>
    				<th>-</th>
    			</thead>
    			<tbody>
    				@foreach($administrators as $administrator)
    				<tr>
    					<td>{{ $administrator->id }}</td>
    					<td>{{ $administrator->name }}</td>
    					<td>{{ $administrator->email }}</td>
    					<td>{{ date('d-m-Y',strtotime($administrator->birthdate)) }}</td>
                        <td>{{ $administrator->address }}</td>
    					<td>
    						<a class="btn btn-info" href="{{ route('users.edit',['id' => $administrator->id]) }}"><i class="fa fa-pencil"></i></a>
    						{!! Form::open(['route' => ['users.destroy',$administrator->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
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
		$("#administrator-table").DataTable();
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

		$("button.delete-record").click(function(){
			if(!confirm("Estas seguro de eliminar este Profesor?")){
				return false;
			}
		});
	})
</script>
@stop