<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AsignacionMultaController;
use App\Http\Controllers\Admin\AsignacionRoomController;
use App\Http\Controllers\Admin\AsignacionTurnoController;
use App\Http\Controllers\Admin\DescontadoController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ImpuestoController;
use App\Http\Controllers\Admin\MetaModeloController;
use App\Http\Controllers\Admin\PaginaController;
use App\Http\Controllers\Admin\PagoController;
use App\Http\Controllers\Admin\RegistroAsistenciaController;
use App\Http\Controllers\Admin\RegistroDescuentoController;
use App\Http\Controllers\Admin\RegistroProducidoController;
use App\Http\Controllers\Admin\ReportePaginaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\TipoDescuentoController;
use App\Http\Controllers\Admin\TipoMetaController;
use App\Http\Controllers\Admin\TipoMultaController;
use App\Http\Controllers\Admin\TipoRoomController;
use App\Http\Controllers\Admin\TipoTurnoController;
use App\Http\Controllers\Admin\TipoUsuarioController;
use App\Http\Controllers\Admin\UserController;

//ROUTES --DescontadoController-- Corresponden a las rutas que administran la tablas de lo que se desucuenta a lo descontado
Route::get('/',[HomeController::class,'index'])->middleware(['auth','verified']);

// Route::resource('users', UserController::class)->middleware(['auth', 'verified'])->names('admin.users');
Route::resource('tenants',TenantController::class)->middleware(['auth','verified'])->names('admin.tenants'); 
Route::get('tenantAsignacionDominio/{tenant}', [TenantController::class, 'agrgarUsuarioDominio'])->middleware(['auth', 'verified'])->name('admin.tenants.tenantAsignacionDominio');


/*
E CASO DE MANDAD TODO AL CARAJO DESBLOQUEAR ESTAS LINEAS
**/
// ROUTES --DescontadoController-- Corresponden a las rutas que administran la tablas de lo que se desucuenta a lo descontado

// Route::get('abonos/{abonoParcial}', [DescontadoController::class, 'abonoParcial'])->middleware(['auth', 'verified'])->name('admin.abonos.abonoParcial');
// Route::post('abonos', [DescontadoController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.abonos.store');
// Route::put('abonos/{abonado}', [DescontadoController::class, 'abono'])->middleware(['auth', 'verified'])->name('admin.abonos.abono');
// Route::resource('abonosResources', DescontadoController::class)->middleware(['auth', 'verified'])->names('admin.abonosResources');

// //ROUTES --PagoController-- Corresponden a las rutas que administran las tablas de los pagos 
// Route::get('comprobantePagoPDF/{pago}', [PagoController::class, 'comprobantePagoPDF'])->middleware(['auth', 'verified'])->name('admin.pagos.comprobantePagoPDF');
// Route::get('enviarPago', [PagoController::class, 'enviarPago'])->middleware(['auth', 'verified'])->name('admin.pagos.enviarPago');
// Route::resource('pagosss', PagoController::class)->middleware(['auth', 'verified'])->names('admin.pagos');

// //ROUTES --RegistroProducidoController-- Corresponden a las rutas que administran las tablas de registro producido
// Route::resource('registroProducidos', RegistroProducidoController::class)->middleware(['auth', 'verified'])->names('admin.registroProducidos');
// Route::get('registroProducidoss', [RegistroProducidoController::class, 'resumen'])->middleware(['auth', 'verified'])->name('admin.registroProducidoss.resumen');
// Route::get('registroProducidoss', [RegistroProducidoController::class, 'reporte_dia'])->middleware(['auth', 'verified'])->name('admin.registroProducidoss.reporte_dia');

// //ROUTES --RegistroAsistenciaController-- Corresponden a las rutas que administran las tablas de registro asistencia
// Route::resource('registroAsistencias', RegistroAsistenciaController::class)->middleware(['auth', 'verified'])->names('admin.registroAsistencias');



// Route::resource('registroDescuentos', RegistroDescuentoController::class)->middleware(['auth', 'verified'])->names('admin.registroDescuentos');
// Route::resource('tipoUsuarios', TipoUsuarioController::class)->middleware(['auth', 'verified'])->names('admin.tipoUsuarios');
// Route::resource('users', UserController::class)->middleware(['auth', 'verified'])->names('admin.users');
// Route::get('userCertificacion', [UserController::class, 'userCertificacion'])->middleware(['auth', 'verified'])->name('admin.users.userCertificacion');
// Route::get('userCertificacionPDF/{user}', [UserController::class, 'certificacionLaboralPDF'])->middleware(['auth', 'verified'])->name('admin.users.certificacionLaboralPDF');
// Route::get('userCertificacionTiempo', [UserController::class, 'certificacionTiempo'])->middleware(['auth', 'verified'])->name('admin.users.certificacionTiempo');
// Route::get('userCertificacionTiempoPDF/{user}', [UserController::class, 'certificacionTiempoPDF'])->middleware(['auth', 'verified'])->name('admin.users.certificacionTiempoPDF');

// // Route::get('users/{user}/rol', [UserController::class,'rol'])->name('admin.users.rol');
// // Route::put('users/{user}',[UserController::class,'updateRol'])->name('admin.users.updateRol');

// Route::get('users/{user}/rol', [UserController::class, 'rol'])->middleware(['auth', 'verified'])->name('admin.users.rol');
// Route::put('users/{user}', [UserController::class, 'updateRol'])->middleware(['auth', 'verified'])->name('admin.users.updateRol');

// Route::resource('roles', RoleController::class)->middleware(['auth', 'verified'])->names('admin.roles');
// Route::resource('asignacionTurnos', AsignacionTurnoController::class)->middleware(['auth', 'verified'])->names('admin.asignacionTurnos');
// Route::resource('tipoTurnos', TipoTurnoController::class)->middleware(['auth', 'verified'])->names('admin.tipoTurnos');
// Route::resource('tipoRooms', TipoRoomController::class)->middleware(['auth', 'verified'])->names('admin.tipoRooms');
// Route::resource('tipoMultas', TipoMultaController::class)->middleware(['auth', 'verified'])->names('admin.tipoMultas');
// Route::resource('tipoDescuentos', TipoDescuentoController::class)->middleware(['auth', 'verified'])->names('admin.tipoDescuentos');
// Route::resource('tipoMetas', TipoMetaController::class)->middleware(['auth', 'verified'])->names('admin.tipoMetas');
// // Route::resource('tipoMonedaPaginas',TipoMonedaPaginaController::class)->middleware(['auth','verified'])->names('admin.tipoMonedaPaginas');
// Route::resource('paginas', PaginaController::class)->middleware(['auth', 'verified'])->names('admin.paginas');
// Route::resource('asignacionRooms', AsignacionRoomController::class)->middleware(['auth', 'verified'])->names('admin.asignacionRooms');
// Route::resource('asignacionMultas', AsignacionMultaController::class)->middleware(['auth', 'verified'])->names('admin.asignacionMultas');
// Route::resource('metaModelos', MetaModeloController::class)->middleware(['auth', 'verified'])->names('admin.metaModelos');




// Route::resource('reportePaginas', ReportePaginaController::class)->middleware(['auth', 'verified'])->names('admin.reportePaginas');
// Route::get('reportePaginass', [ReportePaginaController::class, 'nomina'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.nomina');
// Route::get('reportePaginasss', [ReportePaginaController::class, 'reporteQuincena'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.reporteQuincena');
// Route::get('pagos', [ReportePaginaController::class, 'pagos'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.pagos');
// Route::get('verificadoMasivo', [ReportePaginaController::class, 'verificadoMasivo'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.verificadoMasivo');
// Route::post('reportePaginas/updateStatus', [ReportePaginaController::class, 'updateStatus'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.updateStatus');
// // Route::get('', [ReportePaginaController::class,'pagos'])->name('admin.reportePaginas.pagos');
// //RUTAS INDIVIDUALES
// Route::post('reportePaginass', [ReportePaginaController::class, 'storeIndividual'])->name('admin.reportePaginas.storeIndividual');


// Route::get('cargarExcel', [ReportePaginaController::class, 'cargarExcel'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.cargarExcel');
// Route::resource('empresa', EmpresaController::class)->middleware(['auth', 'verified'])->middleware(['auth', 'verified'])->names('admin.empresa');

// Route::resource('impuestos', ImpuestoController::class)->middleware(['auth', 'verified'])->names('admin.impuestos');
// Route::get('comprobanteImpuestoss', [ImpuestoController::class, 'comprobanteImpuesto'])->middleware(['auth', 'verified'])->name('admin.impuestos.comprobanteImpuestoss');
// Route::get('comprobanteImpuestoPDF/{pago}', [ImpuestoController::class, 'comprobanteImpuestoPDF'])->middleware(['auth', 'verified'])->name('admin.impuestos.comprobanteImpuestoPDF');

