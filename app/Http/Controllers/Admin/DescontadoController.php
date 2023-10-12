<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Descontado;
use App\Models\Descuento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DescontadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Descuento $abonado)
    {
        // parametro para tomar texto de error
        $error = 0;
        //validacion de errores
        if ($request->valor === null) {
            return response()->json(['success' => false, 'error' => 'El campo valor no puede estar vacio']);
        } elseif ($request->descripcion === null) {
            return response()->json(['success' => false, 'error' => 'El campo descripcion no puede estar vacio']);
        }
        //obtenemos los descuentos
        $descuentos = Descuento::find($request->descuento_id);
        //ser guarda un descuento nuevo con todos los campos obtenidos request
        $registroDescuento = Descontado::create($request->all());
        $diferenciaSaldo = $descuentos->montoDescuento - $descuentos->montoDescontado;
        $abonos = Descontado::where('descuento_id', '=', $request->descuento_id)
            ->select('valor')
            ->get()
            ->sum('valor');
        $descuentos->montoDescontado = $abonos;
        $descuentos->save();

               //retornamos Json
        return response()->json(['success' => true, 'error' => $error]);
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
    public function edit(Request $request, Descuento $abonoParcial)
    {
        $abonos = DB::table('descontados')
            ->where('descuento_id', '=', $abonoParcial->id)
            ->get();

        return view('admin.abonos.index', compact('abonos'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //ESTE METODO NOS PERMITE REALIZAR UN ABONO TOTAL ES DECIR DESCUENTA  TODO LO QUE SE ESTE DEBIENDO
    //ES DE TIPO PUT Y NECESITA UN OBJETO DE TIPO Descuento para poder funcionar,  EL CUAL SE ENVIA DESDE LA RUTA registroDescuentos.index
    //CON LA INFORMACION RECIBIDA DESDE LA VISTA  QUE EN ESTE CASO ES UN OBJETO DE TIPO Descuento hacemos lo siguiente
    /*1. verificamos si el saldo es mayor  a 0, si se cumple esta condicion crearme un registro en la tabla Descontado que  es lo mismo a abono
       donde se toma informacion valiosa que nos envia la vista como lo es el saldo y el id del credito

       */
    //     public function abono(Request $request, Descuento $abonado)
    //     {
    // dd('H');
    //         if ($abonado->saldo > 0) {

    //             $abono = Descontado::create([
    //                 'valor' => $abonado->saldo,
    //                 'descripcion' => 'pago total',
    //                 'descuento_id' => $abonado->id,
    //             ]);
    //             $abono->save();
    //         } else {

    //             echo "No hay que descontar";
    //             return redirect()->route('admin.registroDescuentos.index', $abonado->id)->with('info', 'valorCero');
    //         }
    //         /*EN ESTA SEGUNDA PARTE DEL METODO, APROVECHANDO LA INFORMACION ENVIADA POR LA VISTA
    //         LO QUE SE REALIZA ES UN LLAMADO A LA TABLA descontados y se filtra descuento_id que tiene que ser igual $abonado->id
    //         que es id del credito ojo que aca nos suma todos los abonos que se le haya realizado a ese credito y se lo asignamos
    //         al atributo montoDescontado  DE LA TABLA Descuentos  */
    //         $abonos = DB::table('descontados')
    //             ->where('descuento_id', '=', $abonado->id)
    //             ->select('valor')
    //             ->get()
    //             ->sum('valor');
    //         $abonado->montoDescontado = $abonos;
    //         $abonado->save();
    //         echo $abonado->saldo;

    //         return redirect()->route('admin.registroDescuentos.index', $abonado->id)->with('info', 'store');
    //     }
    // !!
    // public function abono(Request $request, Descuento $abonado)
    // {
    //     if ($abonado->saldo > 0) {

    //         $abono = Descontado::create([
    //             'valor' => $abonado->saldo,
    //             'descripcion' => 'pago total',
    //             'descuento_id' => $abonado->id,
    //         ]);
    //         $abono->save();
    //     } else {

    //         echo "No hay que descontar";
    //         return redirect()->route('admin.registroDescuentos.index', $abonado->id)->with('info', 'valorCero');
    //     }
    //     /*EN ESTA SEGUNDA PARTE DEL METODO, APROVECHANDO LA INFORMACION ENVIADA POR LA VISTA
    //     LO QUE SE REALIZA ES UN LLAMADO A LA TABLA descontados y se filtra descuento_id que tiene que ser igual $abonado->id
    //     que es id del credito ojo que aca nos suma todos los abonos que se le haya realizado a ese credito y se lo asignamos
    //     al atributo montoDescontado  DE LA TABLA Descuentos  */
    //     $abonos = DB::table('descontados')
    //         ->where('descuento_id', '=', $abonado->id)
    //         ->select('valor')
    //         ->get()
    //         ->sum('valor');
    //     $abonado->montoDescontado = $abonos;
    //     $abonado->save();
    //     echo $abonado->saldo;

    //     return redirect()->route('admin.registroDescuentos.index', $abonado->id)->with('info', 'store');
    // }

    //funcion para registrar abonos
    public function abono(Request $request, Descuento $abonado)
    {
        if ($abonado->saldo > 0) {
            $abono = Descontado::create([
                'valor' => $abonado->saldo,
                'descripcion' => 'pago total',
                'descuento_id' => $abonado->id,
            ]);
            $abono->save();
        } else {
            // No hay que descontar
            return response()->json(['success' => false]);
        }

        // Realiza el cálculo del monto descontado
        $abonos = Descontado::where('descuento_id', '=', $abonado->id)
            ->select('valor')
            ->get()
            ->sum('valor');
        $abonado->montoDescontado = $abonos;
        $abonado->saldo = 0;
        $abonado->save();

        // Si todo está correcto, devuelve true
        return response()->json(['success' => true, 'abonado' => $abonado]);
    }

    public function datatable(Request $request)
    {
        // dd($request->all());
        $descuento_id = $request->rowId;
        $descontado = Descontado::where('descuento_id', $descuento_id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($descontado as  $item) {
            $item->formatted_created_at = date('d-m-Y', strtotime($item->created_at));
        }
        return DataTables::of($descontado)
            ->addColumn('acciones', function ($row) {
                $acciones = '';

                return $acciones;
            })

            ->rawColumns(['acciones', 'pago', 'saldo'])
            ->make(true);
    }


    //ESTE METODO  SE MANDA A LLAMAR EN EL INDEX DE REGISTRO DESCUENTO Y LO QUE HACE ES LO SIGUIENTE
    //1. ES DE TIPO GET  RECIBE UN OBETO DEL TIPO DESCUENTO
    /*2. LLAMA A LA BASE DE DATOS DE DATOS  DESCONTADOS QUE EN ESTE CASO ES LO MISMO QUE DECIR ABONOS
    Y FILTRA EL descuento_id DONDE SEA IGUAL AL $abonoParcial->id ESTA ULTIMA VARIBLE ES EL REGISTRO QUE TRAEMOS EN
    REQUEST */
    //3. RETORNA UNA VISTA Y ENVIA LA VARIABLE ANTES CONSUTADA CON EL FIN QUE TRAIGA SOLO LOS ABONOS QUE SE LE HA REALZADO A MENCIOANADO CREDITO
    // public function abonoParcial(Request $request, Descuento $abonoParcial)
    // {
    //     // dd($abonoParcial);
    //     // $abonos = DB::table('descontados')
    //     $abonos = Descontado::where('descuento_id', '=', $abonoParcial->id)
    //         ->get();

    //     // echo $abonoParcial->id;
    //     return view('admin.abonos.index', compact('abonos', 'abonoParcial'));
        // return response()->json(['success' => true,'abonos' => $abonos,]);
    // }
}
