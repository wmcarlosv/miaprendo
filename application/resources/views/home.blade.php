@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fullcalendar-4.1.0/packages/core/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fullcalendar-4.1.0/packages/daygrid/main.css') }}">
@stop

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')
	@if(Auth::user()->role == 'administrador')
    <div class="row">
    	<div class="col-md-3 col-sm-6 col-xs-12">
		     <div class="info-box">
		        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
		        <div class="info-box-content">
		          <span class="info-box-text">Estudiantes</span>
		          <span class="info-box-number">{{ $sc }}</span>
		        </div>
		    </div>
	    </div>
	    <div class="col-md-3 col-sm-6 col-xs-12">
		     <div class="info-box">
		        <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
		        <div class="info-box-content">
		          <span class="info-box-text">Profesores</span>
		          <span class="info-box-number">{{ $tc }}</span>
		        </div>
		    </div>
	    </div>
	    <div class="col-md-3 col-sm-6 col-xs-12">
		     <div class="info-box">
		        <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>
		        <div class="info-box-content">
		          <span class="info-box-text">Clases Impartidas</span>
		          <span class="info-box-number">0</span>
		        </div>
		    </div>
	    </div>
	    <div class="col-md-3 col-sm-6 col-xs-12">
		     <div class="info-box">
		        <span class="info-box-icon bg-blue"><i class="fa fa-money"></i></span>
		        <div class="info-box-content">
		          <span class="info-box-text">Horas Impartidas</span>
		          <span class="info-box-number">0</span>
		        </div>
		    </div>
	    </div>
	</div>
	@endif

	@if(Auth::user()->role == 'profesor')
    <div class="row">
    	<div class="col-md-3 col-sm-6 col-xs-12">
		     <div class="info-box">
		        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
		        <div class="info-box-content">
		          <span class="info-box-text">Estudiantes Atendidos</span>
		          <span class="info-box-number">0</span>
		        </div>
		    </div>
	    </div>
	    <div class="col-md-3 col-sm-6 col-xs-12">
		     <div class="info-box">
		        <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>
		        <div class="info-box-content">
		          <span class="info-box-text">Clases Impartidas</span>
		          <span class="info-box-number">0</span>
		        </div>
		    </div>
	    </div>
	</div>
	@endif

	@if(Auth::user()->role == 'estudiante')
    <div class="row">
	    <div class="col-md-3 col-sm-6 col-xs-12">
		     <div class="info-box">
		        <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>
		        <div class="info-box-content">
		          <span class="info-box-text">Clases Recibidas</span>
		          <span class="info-box-number">0</span>
		        </div>
		    </div>
	    </div>
	    <div class="col-md-3 col-sm-6 col-xs-12">
		     <div class="info-box">
		        <span class="info-box-icon bg-blue"><i class="fa fa-money"></i></span>
		        <div class="info-box-content">
		          <span class="info-box-text">Horas Disponiles</span>
		          <span class="info-box-number">{{ Auth::user()->credit }}</span>
		        </div>
		    </div>
	    </div>
	</div>
	@endif

	<div class="row">
		<div class="col-md-12">
			<div id='calendar'></div>
		</div>
	</div>
@stop
@section('js')
<script src="{{ asset('plugins/fullcalendar-4.1.0/packages/core/main.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-4.1.0/packages/core/locale-all.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-4.1.0/packages/interaction/main.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-4.1.0/packages/daygrid/main.js') }}"></script>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid' ],
      editable: true,
      eventLimit: true,
      locale : 'es',
      header : {
      	left : 'prev, next',
      	center : 'title',
      	right : 'dayGridDay,dayGridWeek,dayGridMonth'
      },
      events : [

      	@foreach($calendars as $calendar)
      		@if(Auth::user()->role == 'administrador')
      		{ 
      			title: '{{ $calendar->lesson->title }} ({{ $calendar->status }})',
      			url : '{{ route("calendars.edit",["id" => $calendar->id]) }}',
      			start: '{{ $calendar->lesson_date }}'
      		},
      		@endif

      		@if(Auth::user()->role == 'profesor')
      			@if($calendar->teacher_id == Auth::user()->id)
      				{ 
		      			title: '{{ $calendar->lesson->title }} ({{ $calendar->status }})',
		      			url : '{{ route("calendars.show",["id" => $calendar->id]) }}',
		      			start: '{{ $calendar->lesson_date }}'
		      		},
      			@endif
      		@endif

      		@if(Auth::user()->role == 'estudiante')
  				{ 
	      			title: '{{ $calendar->lesson->title }} ({{ $calendar->status }})',
	      			url : '{{ route("show_student",["id" => $calendar->id]) }}',
	      			start: '{{ $calendar->lesson_date }}'
	      		},
      		@endif
      	@endforeach

      ]
    });

    calendar.render();
  });
</script>
@stop