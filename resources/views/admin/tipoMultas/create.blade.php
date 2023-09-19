@extends('template.index')

@section('tittle-tab')
    Configuracion-tipoMultas-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.tipoMultas.index') }}"> Configuracion-tipoMultas</a>

@endsection

@section('content_header')
    <h2>Crear tipo multas</h2>
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="card">
                <div class="card-header">
                    <div class="row g-2">
                        <div class="col">
                            @yield('content_header')
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {!! Form::open(['route' => 'admin.tipoMultas.store']) !!}
                    {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo multa']) !!}

                        @error('nombre')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('name', 'Costo') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('costo', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo multa']) !!}

                        @error('costo')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>

                    {!! Form::submit('Crear Tipo Multa', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>

@stop
