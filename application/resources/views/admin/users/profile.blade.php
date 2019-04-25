@extends('adminlte::page')

@section('title', 'Editar Perfil')

@section('content')
    @include('flash::message')
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
            <h2>Datos de Usuario</h2>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label>Nombre: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ Auth::user()->name }}">
            </div>
            <div class="form-group">
                <label>Correo: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ Auth::user()->email }}">
            </div>
            <div class="form-group">
                <label>Fecha de Nacimiento: </label>
                <input type="text" readonly="readonly" class="form-control" value="{{ date('d-m-Y',strtotime(Auth::user()->birthdate)) }}">
            </div>
            <div class="form-group">
                <label>Direcci&oacute;n: </label>
                <textarea readonly="readonly" class="form-control">{{ Auth::user()->address }}</textarea>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Cambiar Contrase&ntilde;a</h2>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => ['change_password','id' => Auth::user()->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
            <div class="form-group">
                <label for="password">Nueva Contrase&ntilde;a: </label>
                <input type="password" class="form-control" name="password" id="password" />
            </div>

            <div class="form-group">
                <label for="password_confirmation">Repita Contrase&ntilde;a: </label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" />
            </div>
            <button type="sumit" class="btn btn-success">Guardar</button>
            <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop