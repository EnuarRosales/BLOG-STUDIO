@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignar Rol</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre</p>
            <p class="form-control">{{ $user->name }}</p>
            {!! Form::model($user, ['route' => ['admin.users.updateRol', $user], 'method' => 'put']) !!}
           
            @foreach ($roles as $role)
                <div>
                    <label>
                        {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach 
        </div>
        {!! Form::submit('Asignar Rol', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@stop
