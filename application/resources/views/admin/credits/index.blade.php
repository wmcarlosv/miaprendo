@extends('adminlte::page')

@section('title', 'Creditos')

@section('content')
	@include('flash::message')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Creditos</h2>
    	</div>
    	<div class="panel-body">
    		<a href="{{ route('credits.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Agregar Credito</a>
    		<br />
    		<br />
    		<table class="table" id="credit-table">
    			<thead>
    				<th>ID</th>
    				<th>Estudiante</th>
    				<th>Monto</th>
                    <th>Fecha</th>
    				<th>-</th>
    			</thead>
    			<tbody>
    				@foreach($credits as $credit)
    				<tr>
    					<td>{{ $credit->id }}</td>
    					<td>{{ $credit->user->name }}</td>
    					<td>{{ $credit->amount }}</td>
                        <td>{{ date('d-m-Y H:m:s',strtotime($credit->created_at)) }}</td>
    					<td>
    						<a class="btn btn-info" href="{{ route('credits.show',['id' => $credit->id]) }}"><i class="fa fa-eye"></i></a>
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
		$("#credit-table").DataTable();
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

		$("button.delete-record").click(function(){
			if(!confirm("Estas seguro de eliminar esta Clase?")){
				return false;
			}
		});
	})
</script>
@stop