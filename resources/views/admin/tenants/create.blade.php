@extends('template.index')

{{-- @section('title', 'Dashboard') --}}

@section('content_header')
    <h2 class="ml-3">Crear Inquilinos</h2>
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

            {{-- <div class="card">
                <div class="card-body"> --}}
                    {!! Form::open(['route' => 'admin.tenants.store']) !!}
                    {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

                    <div class="form-group">
                        {!! Form::label('id', 'Nombre') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('id', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un estudio']) !!}

                        @error('id')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>

                    {!! Form::submit('Crear Inquilino', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                {{-- </div>

            </div> --}}
        </div>
    </div>




@stop
