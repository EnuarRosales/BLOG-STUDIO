@extends('adminlte::page')

@section('title', 'Lista tipo descuentos')

@section('content_header')
    <h1>Lista tipo descuentos</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.tipoDescuentos.create') }}">Agregar tipo descuento</a>
        </div>

        @if ($tipoDescuentos->count())
            <table class="table table-striped table-bordered shadow-lg mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipoDescuentos as $tipoDescuento)
                        <tr>
                            <td>{{ $tipoDescuento->id }}</td>
                            <td>{{ $tipoDescuento->nombre }}</td>
                            <td width="10px">
                                <a class="btn btn-secondary btn-sm"
                                    href="{{ route('admin.tipoDescuentos.edit', $tipoDescuento) }}">Editar</a>
                            </td>

                            <td width="10px">
                                <form class="formulario-eliminar"
                                    action="{{ route('admin.tipoDescuentos.destroy', $tipoDescuento) }}" method="POST">
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
                title: 'Tipo Descuento creado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Tipo Descuento actualizado correctamente',
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
