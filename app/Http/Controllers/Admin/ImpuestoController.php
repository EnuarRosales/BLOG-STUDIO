<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Impuesto;
use App\Models\Pago;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class ImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impuestos = Impuesto::all();
        return view('admin.impuestos.index', compact('impuestos'));
    }

    public function comprobanteImpuesto()
    {
        $user = Auth::user();
        $userId = Auth::id();

        if ($user->hasPermissionTo('admin.certificacion.pago')) {
            if ($user->hasPermissionTo('certificaciones.personal')) {
                $impuestos = Impuesto::all();
                $pagos = Pago::where('pagado', 1)
                    ->where('user_id', $user->id)
                    ->get();

                foreach ($pagos as $pago) {
                    $fecha = Carbon::parse($pago->fecha);
                    $pago->mes = $fecha->format('m');
                    $pago->anio = $fecha->format('Y');
                }
                $anios = $pagos->unique('anio')->pluck('anio');
                return view('admin.impuestos.comprobanteImpuesto', compact('pagos', 'anios', 'impuestos'));
            }
            $impuestos = Impuesto::all();
            $userLogueado = auth()->user()->id;

            $pagos = Pago::leftJoin('users', 'users.id', '=', 'pagos.user_id')
                //   ->select('users.name', 'pagos.id','pagos.fecha','pagos.pagado', 'pagos.devengado', 'pagos.descuento', 'pagos.impuestoDescuento', 'pagos.multaDescuento')
                ->select('users.name', 'pagos.*')
                ->get();

            foreach ($pagos as $pago) {
                $fecha = Carbon::parse($pago->fecha);
                $pago->mes = $fecha->format('m');
                $pago->anio = $fecha->format('Y');
            }
            $anios = $pagos->unique('anio')->pluck('anio');
            return view('admin.impuestos.comprobanteImpuesto', compact('pagos', 'anios', 'impuestos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.impuestos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALiDACION FORMULARIO
        $request->validate([
            'nombre' => 'required',
            'porcentaje' => 'required',
            'mayorQue' => 'required',



        ]);
        $impuesto = Impuesto::create($request->all());
        return redirect()->route('admin.impuestos.index', $impuesto->id)->with('info', 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Impuesto $impuesto)
    {
        return view('admin.impuestos.edit', compact('impuesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Impuesto $impuesto)
    {
        if ($request->has('radio')) {
            // obtnemos todos los impuestos
            $zero = Impuesto::all();
            // recorremos la coleccion
            foreach ($zero as $item) {
                // volvemos a todo inactivos
                $item->estado = 0;
                $item->update();
            }
            // volvemos activo el seleccionado en la pantalla
            $impuesto->update($request->except('radio'));
            return response()->json(['success' => true]);
        }

        //VALLIDACION DE FORMULARIOS
        $request->validate([
            'nombre' => 'required',
            'porcentaje' => 'required',
            'mayorQue' => 'required',
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $impuesto->update($request->all());
        return redirect()->route('admin.impuestos.index', $impuesto->id)->with('info', 'update'); //with mensaje de sesion
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impuesto $impuesto, Request $request)
    {

        // dd($impuesto);
        $impuesto->delete();
        return redirect()->route('admin.impuestos.index')->with('info', 'delete');
    }



    public function comprobanteImpuestoPDF(Pago $pago)
    {

        //CONSULTADO USUARIOS ASI ESTES ELIMINADOS
        $user = User::withTrashed()
            ->where('id', $pago->user_id)->get();

        foreach ($user as $i) {
            $nombreUsuario = $i->name;
            $cedulaUsuario = $i->cedula;
        }
       


        $empresas = Empresa::all();
        foreach ($empresas as $empresa) {
            $nombreEmpresa = $empresa->name;
            $nitEmpresa = $empresa->nit;
            $logoEmpresa = $empresa->logo;
        }

        $codigoQR = QrCode::size(80)->generate(
            "CERTIFICACION IMPUESTO" . "\n" .
                "NOMBRE: " . $nombreUsuario . "\n" .
                "FECHA: " . $pago->fecha . "\n" .
                "CONCEPTO: " . ($pago->impuestos->nombre ?? 'N/A') . "\n" .  // Usar 'N/A' si el nombre es nulo
                "PORCENTAJE: " . $pago->impuestoPorcentaje . " %" . "\n" .
                "BASE GRABABLE: " . "$ " . number_format($pago->devengado, 2, '.', ',') . "\n" .
                "RETENIDO: " . "$ " . number_format($pago->impuestoDescuento, 2, '.', ',') . "\n"
        );


        // $pagos = Pago::where('user_id', $pago->id)->get();
        $date = Carbon::now()->locale('es');
        try {
            $pdf = Pdf::loadView('admin.impuestos.comprobanteImpuestoPDF', compact('cedulaUsuario','nombreUsuario','pago', 'date', 'nombreEmpresa', 'nitEmpresa', 'codigoQR', 'logoEmpresa'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $message = substr($errorMessage, strpos($errorMessage, '$') + 1);
            return back()->with('mensaje', "Falta Informacion sobre: " . $message);
        }
        return $pdf->stream();
    }
}
