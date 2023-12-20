@extends('template.index')

@section('tittle-tab')
    Personal-Asignacion Turno
@endsection

@section('page-title')
    <a href="{{ route('admin.users.index') }}">Personal-Asignacion Turno</a>
@endsection

@section('content_header')
    <h2 class="ml-3">Asignacion Turno</h2>
@stop

@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">

@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="row g-2">
                <div class="col">
                    <div style="display: flex;">
                        <label class="mt-2 ml-3 mr-1">Registros :</label>
                        <select id="records-per-page" class="form-control custom-width-20">
                            <!-- Agregamos la clase form-control-sm -->
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                        <span class="ml-2 mt-2"></span>
                    </div>
                    <div class="mq-960">

                        @can('admin.asignacionTurnos.create')
                            <a class="btn btn-primary float-right mr-4"
                                href="{{ route('admin.asignacionTurnos.create') }}">Agregar
                                Asignacion
                                Turno</a>
                        @endcan
                    </div>

                </div>
            </div>
            <div class="table-responsive mb-4 mt-4">
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo Persona</th>
                            <th>Turno Asignado</th>
                            <th>Celular</th>
                            @can('admin.asignacionTurnos.edit')
                                <th>Editar</th>
                            @endcan
                            @can('admin.asignacionTurnos.destroy')
                                <th>Eliminar</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asignacionTurnos as $asignacionTurno)
                            <tr>
                                <td>{{ $asignacionTurno->id }}</td>
                                <td>{{ $asignacionTurno->user->name }}</td>
                                <td>{{ $asignacionTurno->user->tipoUsuario->nombre ?? 'Vacio' }}</td>
                                <td>{{ $asignacionTurno->turno->nombre ?? 'Vacio' }}</td>
                                <td>{{$asignacionTurno->user->celular}}</td>
                                @can('admin.asignacionTurnos.edit')
                                    <td width="10px">
                                        <a href="{{ route('admin.asignacionTurnos.edit', $asignacionTurno) }}"
                                            class="ml-4 rounded bs-tooltip" data-placement="top" title="Editar">
                                            <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                @endcan
                                @can('admin.asignacionTurnos.destroy')
                                    <td width="10px">
                                        <a href="javascript:void(0);" class="ml-2 eliminar-registro rounded bs-tooltip"
                                            data-placement="top" title="Eliminar"
                                            data-asignacionTurno-id="{{ $asignacionTurno->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x-circle table-cancel">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                            </svg>
                                        </a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo Persona</th>
                            <th>Turno Asignado</th>
                            @can('admin.asignacionTurnos.edit')
                                <th>Editar</th>
                            @endcan
                            @can('admin.asignacionTurnos.destroy')
                                <th>Eliminar</th>
                            @endcan
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    {{-- <div class="card">
        <div class="card-body">


        </div>
        <table id="asignacionTurnos" class="table table-striped table-bordered shadow-lg mt-4">


        </table>

    </div> --}}

@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
@stop

@section('js')
    <script src="{{ asset('template/plugins/table/datatable/datatables.js') }}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('template/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('template/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>

    <script>
        var table = $('#html5-extension').DataTable({
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [{
                        extend: 'copy',
                        className: 'btn'
                    },
                    {
                        extend: 'csv',
                        className: 'btn'
                    },
                    {
                        extend: 'excel',
                        className: 'btn'
                    },
                    {
                        extend: 'print',
                        className: 'btn'
                    }
                ]
            },
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Página _PAGE_ de _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Buscar...",
                "sLengthMenu": "Mostrar _MENU_ resultados por página",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });

        // Vincular eventos de clic para eliminar
        function bindDeleteEvents() {
            document.querySelectorAll('.eliminar-registro').forEach(botonEliminar => {
                botonEliminar.addEventListener('click', function(e) {
                    e.preventDefault();

                    const asignacionTurnoId = this.getAttribute('data-asignacionTurno-id');

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '¡Este registro se eliminará definitivamente!',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡Sí, eliminar!',
                        cancelButtonText: '¡Cancelar!',
                        preConfirm: () => {
                            // Crear un formulario dinámicamente
                            const formulario = document.createElement('form');
                            formulario.action =
                                `asignacionTurnos/${asignacionTurnoId}`; // Ruta de eliminación
                            formulario.method = 'POST'; // Método POST
                            formulario.style.display = 'none'; // Ocultar el formulario

                            // Agregar el token CSRF al formulario
                            const tokenField = document.createElement('input');
                            tokenField.type = 'hidden';
                            tokenField.name = '_token';
                            tokenField.value = '{{ csrf_token() }}';
                            formulario.appendChild(tokenField);

                            // Agregar un campo oculto para indicar que es una solicitud de eliminación
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            formulario.appendChild(methodField);

                            // Adjuntar el formulario al documento y enviarlo
                            document.body.appendChild(formulario);
                            formulario.submit();

                            return true;
                        },
                    });
                });
            });
        }

        // Volver a vincular eventos de clic después de cada redibujo
        table.on('draw.dt', function() {
            bindDeleteEvents();
        });

        // Detectar cambios en el select
        $('#records-per-page').change(function() {
            var newLength = $(this).val();
            table.page.len(newLength).draw();
        });

        // Vincular eventos de clic para eliminar inicialmente
        bindDeleteEvents();
    </script>

    {{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}



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
                type: 'success',
                title: 'Asignacion de turno realizada correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Asignacion de turno editada correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif



    {{-- <script>
        document.querySelectorAll('.eliminar-registro').forEach(botonEliminar => {
            botonEliminar.addEventListener('click', function(e) {
                e.preventDefault();

                const asignacionTurnoId = this.getAttribute('data-asignacionTurno-id');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¡Este registro se eliminará definitivamente!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, eliminar!',
                    cancelButtonText: '¡Cancelar!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Crear un formulario dinámicamente
                        const formulario = document.createElement('form');
                        formulario.action =
                        `asignacionTurnos/${asignacionTurnoId}`; // Ruta de eliminación
                        formulario.method = 'POST'; // Método POST
                        formulario.style.display = 'none'; // Ocultar el formulario

                        // Agregar el token CSRF al formulario
                        const tokenField = document.createElement('input');
                        tokenField.type = 'hidden';
                        tokenField.name = '_token';
                        tokenField.value = '{{ csrf_token() }}';
                        formulario.appendChild(tokenField);

                        // Agregar un campo oculto para indicar que es una solicitud de eliminación
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        formulario.appendChild(methodField);

                        // Adjuntar el formulario al documento y enviarlo
                        document.body.appendChild(formulario);
                        formulario.submit();
                    }
                });
            });
        });
    </script> --}}

    {{-- DATATATABLE --}}
    <script>
        $(document).ready(function() {
            $('#asignacionTurnos').DataTable({
                dom: 'Blfrtip',

                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

        });
    </script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
@stop
