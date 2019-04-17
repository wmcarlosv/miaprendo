@extends('adminlte::page')

@section('title', 'Clases')

@section('content')
	@include('flash::message')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Clases</h2>
    	</div>
    	<div class="panel-body">
    		<a href="{{ route('lessons.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva Clase</a>
    		<br />
    		<br />
    		<table class="table" id="lesson-table">
    			<thead>
    				<th>ID</th>
    				<th>Titulo</th>
    				<th>Description</th>
    				<th>-</th>
    			</thead>
    			<tbody>
    				@foreach($lessons as $lesson)
    				<tr>
    					<td>{{ $lesson->id }}</td>
    					<td>{{ $lesson->title }}</td>
    					<td>{{ $lesson->description }}</td>
    					<td>
    						<a class="btn btn-info" href="{{ route('lessons.edit',['id' => $lesson->id]) }}"><i class="fa fa-pencil"></i></a>
    						{!! Form::open(['route' => ['lessons.destroy',$lesson->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
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
		$("#lesson-table").DataTable();
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

		$("button.delete-record").click(function(){
			if(!confirm("Estas seguro de eliminar esta Clase?")){
				return false;
			}
		});
	})
</script>
@stop