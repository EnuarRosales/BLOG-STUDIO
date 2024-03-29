@extends('template.index')

@section('tittle-tab')
    DASHBOARD
@endsection

@section('page-title')
    DASHBOAR
@endsection

@section('styles')
    <link href="{{ asset('template/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/plugins/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/plugins/noUiSlider/custom-nouiSlider.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/plugins/bootstrap-range-Slider/bootstrap-slider.css') }}" rel="stylesheet"
        type="text/css">
@endsection



@section('content')




    @can('admin.dashboard')
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="row widget-statistic">
                @include('admin.index.partials.usuario_widget')
                @include('admin.index.partials.multas_widget')
                @include('admin.index.partials.prestamo_widget')
                @include('admin.index.partials.meta_widget')

            </div>

            <div>
                @include('admin.index.partials.tablaAsistenciaPersonal')
            </div>

            <div>
                @include('admin.index.partials.tablaMetaResumen')
            </div>

            {{-- INICIA TABLA --}}

            {{-- TERMINA TABLA --}}
            {{-- HISTORIAL DE METAS --}}

            @include('admin.index.partials.historial_meta_turno')

            {{-- FINAL HISTORIAL DE METAS --}}



            {{-- 1 IMAGEN COMENTADA HASTA QUE ESTE LISTO TODO --}}

            {{-- <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="mb-4">Using HTML5 input elements</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area align-center">
                            <div class="container">
                                <div id="html5"></div>
                                <br />
                                <div class="row mt-4 mb-4">
                                    <div class="col-lg-6 mb-3">
                                        <select id="input-select" class="form-control"></select>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" min="-20" max="40" step="1"
                                            id="input-number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}


            <!-- En tu archivo Blade -->

            {{-- @foreach ($transactions as $transaction)
                    <div class="transactions-list">
                        <!-- ... (código de transacción) ... -->
                    </div>
                @endforeach --}}



            <div class="row">
                @include('admin.index.partials.grafico_quincena')

                @include('admin.index.partials.facturado_quincena_widget')
            </div>
        </div>

        
        
        {{-- <div class="row">
            <div id="chartColumn" class="col-xl-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Estadisticas de Paginas por Periodos</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div id="s-col" class=""></div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-three">
                    <div class="widget-heading">
                        <h5 class="">Periodo por modelos</h5>
                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table" id="table_controlasistencia">
                                <thead>
                                    <tr>
                                        <th>Modelo</th>
                                        @foreach ($dataModelosQuincena['fechasUnicas'] as $fecha)
                                            <th>{{ $fecha }}</th>
                                        @endforeach
                                        <th>Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataModelosQuincena['nombresModelosPorUsuario'] as $userId => $nombreModelo)
                                        <tr>
                                            <td>{{ $nombreModelo }}</td>
                                            @foreach ($dataModelosQuincena['sumatoriasPorFechaPorUsuario'][$userId] as $fecha => $total)
                                                @php
                                                    $color = $dataModelosQuincena['coloresPorUsuario'][$userId][$fecha] ?? 'rojo'; // Color predeterminado
                                                @endphp
                                                <td> <span class="badge badge-{{ $color }}">$
                                                        {{ $total['sumatoriaNetoPesos'] }} COP</span>
                                                </td>

                                               
                                            @endforeach
                                            <td> ${{ $dataModelosQuincena['totalespesonetoquincena'][$userId] }} COP</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    @endcan
@endsection

@section('js')
    <script src="{{ asset('template/plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/dashboard/dash_1.js') }}"></script>
    <script src="{{ asset('template/assets/js/dashboard/dash_2.js') }}"></script>


    <script>
        var chart; // Variable global para almacenar el gráfico

        function createChartMulta(data, id) {
            var chartOptions = {
                // Configuración de tu gráfico
                chart: {
                    id: id,
                    type: 'area',
                    height: 160,
                    sparkline: {
                        enabled: true
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Multas',
                    data: data
                }],
                labels: ['1', '2', '3', '4', '5', '6', '7'],
                yaxis: {
                    min: 0
                },
                colors: ['#e7515a'],
                tooltip: {
                    x: {
                        show: false,
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .40,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                }
            };

            chart = new ApexCharts(document.querySelector("#hybrid_followers1"), chartOptions);
            chart.render();
        }

        function createChartDescuento(data, id) {
            var chartOptions = {
                // Configuración de tu gráfico
                chart: {
                    id: id,
                    type: 'area',
                    height: 160,
                    sparkline: {
                        enabled: true
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: 'Prestamos',
                    data: data
                }],
                labels: ['1', '2', '3', '4', '5', '6', '7'],
                yaxis: {
                    min: 0
                },
                colors: ['#8dbf42'],
                tooltip: {
                    x: {
                        show: false,
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .40,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
            };

            chart = new ApexCharts(document.querySelector("#hybrid_followers3"), chartOptions);
            chart.render();
        }

        function createChartUsuario(data, id) {
            var chartOptions = {
                chart: {
                    id: id,
                    type: 'area',
                    height: 160,
                    sparkline: {
                        enabled: true
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Modelos Incorporados',
                    data: data
                }],
                labels: ['1', '2', '3', '4', '5', '6', '7'],
                yaxis: {
                    min: 0
                },
                colors: ['#1b55e2'],
                tooltip: {
                    x: {
                        show: false,
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .40,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
            }

            chart = new ApexCharts(document.querySelector("#hybrid_followers"), chartOptions);
            chart.render();
        }

        function refreshChartDataMulta() {
            // Realiza una petición AJAX para obtener los nuevos datos de la gráfica
            $.ajax({
                type: 'GET',
                url: 'getdatamultas', // Reemplaza con la URL correcta
                success: function(data) {

                    var array_multa = JSON.parse(data);
                    console.log(array_multa);

                    // Actualiza la serie del gráfico con los nuevos datos
                    ApexCharts.exec('multas', 'updateSeries', [{
                        data: array_multa
                    }], true);

                }
            });
        }

        function refreshChartDataDescuento() {
            // Realiza una petición AJAX para obtener los nuevos datos de la gráfica
            $.ajax({
                type: 'GET',
                url: 'getdatadescuentos', // Reemplaza con la URL correcta
                success: function(data) {

                    var array_descuento = JSON.parse(data);
                    console.log(array_descuento);

                    // Actualiza la serie del gráfico con los nuevos datos
                    ApexCharts.exec('descuento', 'updateSeries', [{
                        data: array_descuento
                    }], true);

                }
            });
        }

        function refreshChartDataUsuario() {
            // Realiza una petición AJAX para obtener los nuevos datos de la gráfica
            $.ajax({
                type: 'GET',
                url: 'getdatausuarios', // Reemplaza con la URL correcta
                success: function(data) {

                    // var array_descuento = JSON.parse(data);
                    var array_usuarios = JSON.parse(data[0]);

                    console.log(array_usuarios);

                    // Actualiza la serie del gráfico con los nuevos datos
                    ApexCharts.exec('usuario', 'updateSeries', [{
                        data: array_usuarios
                    }], true);

                }
            });
        }

        $(document).ready(function() {
            createChartMulta({{ $dataMultas }}, 'multas');
            createChartDescuento({{ $dataDescuentos }}, 'descuento');
            createChartUsuario({{ $dataUsuarios[0] }}, 'usuario');


            // Crear la gráfica inicial al cargar la página

            window.Echo.channel('multas_widget')
                .listen('.reload-multas', (e) => {
                    // Actualiza el contenido dentro del div con la clase 'widget-referral'
                    $('#multas').load(location.href + ' #multas', function() {
                        // ApexCharts.exec('multas', 'updateSeries', [{
                        //     data: {{ $dataMultas }}
                        // }], true);
                        refreshChartDataMulta();
                    });


                });

            window.Echo.channel('metas_widget')
                .listen('.reload-metas', (data) => {

                    //console.log(data.estatico);
                    $('#meta_cantidad').load(location.href + ' #meta_cantidad');
                    $('#meta_nombre').load(location.href + ' #meta_nombre');
                    $('#table_resumenmeta').load(location.href + ' #table_resumenmeta');
                    $('#segunda_meta').load(location.href + ' #segunda_meta');
                    $('#segunda_meta_progreso').load(location.href + ' #segunda_meta_progreso');
                    $('#tercera_meta').load(location.href + ' #tercera_meta');
                    $('#cuarta_meta').load(location.href + ' #cuarta_meta');


                    var historialmetas = data.historialmetas;

                    console.log(historialmetas);
                    // Función para actualizar la barra de progreso
                    function actualizarBarraDeProgreso() {
                        var barraDeProgreso = document.getElementById('progeso_meta');
                        var valorProgreso = historialmetas[1] + '%';
                        //barraDeProgreso.setAttribute('aria-valuenow', progreso);
                        barraDeProgreso.style.width = valorProgreso;

                        var barraDeProgreso2 = document.getElementById('segunda_meta_progreso');
                        var valorProgreso2 = historialmetas[5] + '%';
                        //barraDeProgreso.setAttribute('aria-valuenow', progreso);
                        barraDeProgreso2.style.width = valorProgreso2;

                        var barraDeProgreso3 = document.getElementById('tercera_meta_progreso');
                        var valorProgreso3 = historialmetas[9] + '%';
                        //barraDeProgreso.setAttribute('aria-valuenow', progreso);
                        barraDeProgreso3.style.width = valorProgreso3;

                        var barraDeProgreso4 = document.getElementById('cuarta_meta_progreso');
                        var valorProgreso4 = historialmetas[13] + '%';
                        //barraDeProgreso.setAttribute('aria-valuenow', progreso);
                        barraDeProgreso4.style.width = valorProgreso4;
                    }

                    // Llama a la función para actualizar la barra de progreso
                    actualizarBarraDeProgreso();


                });



            window.Echo.channel('descuentos_widget')
                .listen('.reload-descuentos', (e) => {

                    $('#descuentos').load(location.href + ' #descuentos');
                    refreshChartDataDescuento();
                });


            window.Echo.channel('usuarios_widget')
                .listen('.reload-usuarios', (e) => {

                    $('#usuarios').load(location.href + ' #usuarios');
                    refreshChartDataUsuario();
                });

            window.Echo.channel('control_asistencia')
                .listen('.reload-asistencia', (e) => {

                    $('#table_controlasistencia').load(location.href + ' #table_controlasistencia');

                });
            window.Echo.channel('control_turnos')
                .listen('.reload-turnos', (e) => {
                    console.log(e);

                    function actualizarBarraDeProgresoTurnos() {
                        var barraDeManana = document.getElementById('progreso_manana');
                        var valorManana = e[0] + '%';
                        //barraDeManana.setAttribute('aria-valuenow', Manana);
                        barraDeManana.style.width = valorManana;

                        var barraDeTarde = document.getElementById('progreso_tarde');
                        var valorTarde = e[2] + '%';
                        //barraDeTarde.setAttribute('aria-valuenow', Tarde);
                        barraDeTarde.style.width = valorTarde;

                        var barraDeNoche = document.getElementById('progreso_noche');
                        var valorNoche = e[4] + '%';
                        //barraDeNoche.setAttribute('aria-valuenow', Noche);
                        barraDeNoche.style.width = valorNoche;
                    }

                    actualizarBarraDeProgresoTurnos();

                    $('#cantidad_noche').load(location.href + ' #cantidad_noche');
                    $('#cantidad_tarde').load(location.href + ' #cantidad_tarde');
                    $('#cantidad_manana').load(location.href + ' #cantidad_manana');
                });

        });
    </script>
    {{-- Using HTML5 input elements --}}
    <script>
        var html5Slider = document.getElementById('html5');

        noUiSlider.create(html5Slider, {
            start: [10, 30],
            connect: true,
            tooltips: true,
            range: {
                'min': -20,
                'max': 40
            }
        });
    </script>

    {{-- Apex (Simple) --}}
    <script>
        // Realiza una petición AJAX para obtener los nuevos datos de la gráfica
        $.ajax({
            type: 'GET',
            url: 'getdataquincenas', // Reemplaza con la URL correcta
            success: function(data) {
                var fechasEscapadas = JSON.parse(data.fechas);
                var totalPagos = JSON.parse(data.totalPagos);
                console.log(fechasEscapadas);
                console.log(totalPagos);

                var sline = {
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false,
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    series: [{
                        name: "Producción",
                        data: totalPagos,
                    }],
                    title: {
                        text: 'Facturado por periodo en dolares',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f1f2f3', 'transparent'],
                            opacity: 0.5
                        },
                    },
                    xaxis: {
                        categories: fechasEscapadas,
                    }
                };

                var chart = new ApexCharts(
                    document.querySelector("#s-line"),
                    sline
                );

                chart.render();
            }
        });
    </script>

    {{-- Simple Column --}}
    <script>
        var seriesPorPagina = @json($datapaginas['seriesPorPagina']);
        var fechaQuincenas = @json($datapaginas['fechaQuincenas']);

        var sCol = {
            chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: seriesPorPagina,
            xaxis: {
                categories: fechaQuincenas,
            },
            yaxis: {
                title: {
                    text: '$ (COP)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " COP"
                    }
                }
            }
        };

        var chart = new ApexCharts(
            document.querySelector("#s-col"),
            sCol
        );

        chart.render();
    </script>


    <script src="{{ asset('template/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('template/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('template/plugins/noUiSlider/nouislider.min.js') }}"></script>
    <script src="{{ asset('template/plugins/flatpickr/custom-flatpickr.js') }}"></script>
    <script src="{{ asset('template/plugins/noUiSlider/custom-nouiSlider.js') }}"></script>
    <script src="{{ asset('template/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js') }}"></script>
@endsection
