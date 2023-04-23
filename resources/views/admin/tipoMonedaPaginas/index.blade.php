@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado tipo moneda paginas</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.tipoMonedaPaginas.create') }}">Agregar tipo moneda pagina</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Valor</th>
                    <th colspan="2"</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($tipoMonedaPaginas as $tipoMonedaPagina)
                    <tr>
                        <td>{{ $tipoMonedaPagina->id }}</td>
                        <td>{{ $tipoMonedaPagina->nombre}}</td>
                        <td>{{ $tipoMonedaPagina->valor }}</td>
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.tipoMonedaPaginas.edit', $tipoMonedaPagina) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{ route('admin.tipoMonedaPaginas.destroy', $tipoMonedaPagina) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
                            </form>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
