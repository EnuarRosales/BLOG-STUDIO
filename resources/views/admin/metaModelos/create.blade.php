@extends('template.index')

@section('tittle-tab')
    Configuracion-Metas-Modelos-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.metaModelos.index') }}"> Configuracion-Metas-Modelos</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Crear Meta Modelo</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

            {{-- <div class="card">
                <div class="card-body"> --}}
                    {!! Form::open(['route' => 'admin.metaModelos.store']) !!}
                    {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

                    <div class="form-group">
                        {!! Form::label('mayorQue', 'MayorQue') !!}
                        {!! Form::number('mayorQue', null, ['class' => 'form-control']) !!}
                        @error('mayorQue')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('porcentaje', 'Porcentaje') !!}
                        {!! Form::number('porcentaje', null, ['class' => 'form-control']) !!}
                        @error('porcentaje')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>

                    {!! Form::submit('Crear Meta Modelo', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
{{--
                </div>

            </div> --}}
        </div>
    </div>

@stop
