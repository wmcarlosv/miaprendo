@extends('adminlte::page')

@section('title', 'Mis Clases')

@section('content')
	@include('flash::message')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Mis Clases</h2>
    	</div>
    	<div class="panel-body">
    		<table class="table" id="calendar-table">
    			<thead>
    				<th>ID</th>
                    <th>Profesor</th>
    				<th>Fecha</th>
    				<th>Hora Desde</th>
                    <th>Hora Hasta</th>
                    <th>Clase</th>
                    <th>Precio de la Clase</th>
    			</thead>
    			<tbody>
    				@foreach($calendars as $calendar)
    				<tr>
    					<td>{{ $calendar->id }}</td>
                        <td>{{ $calendar->teacher->name }}</td>
    					<td>{{ date('d-m-Y',strtotime($calendar->lesson_date)) }}</td>
    					<td>{{ $calendar->time_from }}</td>
                        <td>{{ $calendar->time_to }}</td>
                        <td>{{ $calendar->lesson->title }}</td>
                        <td>{{ $calendar->lesson_price }}</td>
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
		$("#calendar-table").DataTable();
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

		$("button.delete-record").click(function(){
			if(!confirm("Estas seguro de eliminar esta Clase?")){
				return false;
			}
		});
	})
</script>
@stop