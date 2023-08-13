@extends('adminlte::page')

@section('title', 'Lista metas modelos')

@section('content_header')
    <h1>Lista metas modelos</h1>
@stop


@section('content')

    {{-- @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif --}}

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.metaModelos.create') }}">Agregar Meta Modelo</a>
        </div>
        @if ($metaModelos->count())
            <table class="table table-striped table-bordered shadow-lg mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mayor Que</th>
                        <th>Porcentaje</th>
                        <th>Editar</th>
                        <th>Eliminar</th>


                    </tr>
                </thead>


                <tbody>
                    @foreach ($metaModelos as $metaModelo)
                        <tr>
                            <td>{{ $metaModelo->id }}</td>
                            <td>{{ $metaModelo->mayorQue }}</td>
                            <td>{{ $metaModelo->porcentaje }}</td>
                            <td width="10px">
                                <a class="btn btn-secondary btn-sm"
                                    href="{{ route('admin.metaModelos.edit', $metaModelo) }}">Editar</a>
                            </td>

                            <td class="bg-light" width="10px">
                                <form class="formulario-eliminar"
                                    action="{{ route('admin.metaModelos.destroy', $metaModelo) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else()
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif


    </div>

@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SWET ALERT --}}
    @if (session('info') == 'delete')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'El registro se elimino con exito',
                'success'
            )
        </script>
    @elseif(session('info') == 'store')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Tipo Usuario realizado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Tipo Usuario actualizado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas Seguro?',
                text: "¡Este registro se eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, eliminar!',
                cancelButtonText: '¡Cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })

        })
    </script>

@stop