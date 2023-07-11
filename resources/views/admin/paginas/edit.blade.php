@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar paginas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($pagina, ['route' => ['admin.paginas.update', $pagina], 'method' => 'put']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese una pagina']) !!}
                @error('nombre')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror
                
                {!! Form::label('moneda', 'Moneda') !!}
                {!! Form::select('moneda', ['dolar' => 'dolar', 'euro' => 'euro'], null , ['id' =>'moneda','class' => 'form-control',
                    ]) !!}

                    @error('moneda')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                {!! Form::label('name', 'Valor') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un valor']) !!}
                @error('valor')
                    <br>
                    <span class="text-danger">{{$message}}</span>
                    <br>
                @enderror

            </div>
            {!! Form::submit('Actualizar Pagina', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
