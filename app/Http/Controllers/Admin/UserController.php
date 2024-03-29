<?php

namespace App\Http\Controllers\Admin;

use App\Events\usuarios_widget;
use App\Http\Controllers\Controller;
use App\Models\AsignacionRoom;
use App\Models\AsignacionTurno;
use App\Models\Empresa;
use App\Models\Pago;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //PARA PROTEGER LAS RUTAS ESTO PERMITE QUE NO SE ACCEDAN SE HACE DE ESTA MANERA YA QUE LA RUTA ES RESOURCE
    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // $users = User::all();
            $users = User::with('tipoUsuario')
                ->get();
            return view('admin.users.index', compact('users'));
        } catch (\Exception $exception) {
            Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    public function userCertificacion()
    {
        // Obtén el usua rio autenticado
        $user = Auth::user();
        //Obtén el ID del usuario autenticado
        $userId = Auth::id();
        // dd($user->id);
        // Verifica si el usuario tiene el permiso "editar_posts"
        if ($user->hasPermissionTo('admin.certificacion.laboral')) {
            if ($user->hasPermissionTo('certificaciones.personal')) {
                try {
                    $users = User::where('id', $user->id)->where('active', 1)->get();
                    $date = Carbon::now()->locale('es');
                    $fechaReciente = Carbon::now();
                    foreach ($users  as $user) {
                        $fechaAntigua1 = Carbon::parse($user->fechaIngreso);
                        $fechaAntigua = $fechaAntigua1->locale('es');
                        $cantidadAno = $fechaAntigua->diff($fechaReciente);
                        $year[] = $cantidadAno->y;
                        $month[] = $cantidadAno->m;
                        $day[] = $cantidadAno->d;
                    }
                    $i = 0;
                    return view('admin.users.certificacionTiempo', compact('users', 'year', 'month', 'day', 'i'));
                } catch (\Exception $exception) {
                    Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
                }
            }
            try {

                $userLogueado = auth()->user()->id;
                $users = User::all()->where('active', 1);
                $date = Carbon::now()->locale('es');
                $fechaReciente = Carbon::now();
                foreach ($users  as $user) {
                    $fechaAntigua1 = Carbon::parse($user->fechaIngreso);
                    $fechaAntigua = $fechaAntigua1->locale('es');
                    $cantidadAno = $fechaAntigua->diff($fechaReciente);
                    $year[] = $cantidadAno->y;
                    $month[] = $cantidadAno->m;
                    $day[] = $cantidadAno->d;
                }
                $i = 0;
                return view('admin.users.certificacionTiempo', compact('users', 'year', 'month', 'day', 'i'));
            } catch (\Exception $exception) {
                Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
            }
        }
    }



    public function certificacionTiempo()
    {    // Obtén el usua rio autenticado
        $user = Auth::user();
        //Obtén el ID del usuario autenticado
        $userId = Auth::id();
        // dd($user->id);
        // Verifica si el usuario tiene el permiso "editar_posts"
        if ($user->hasPermissionTo('admin.certificacion.tiempo')) {
            if ($user->hasPermissionTo('certificaciones.personal')) {
                try {
                    // $userLogueado = auth()->user()->id;
                    $users = User::where('id', $user->id)->where('active', 1)->get();
                    $date = Carbon::now()->locale('es');
                    $fechaReciente = Carbon::now();
                    foreach ($users  as $user) {
                        $fechaAntigua1 = Carbon::parse($user->fechaIngreso);
                        $fechaAntigua = $fechaAntigua1->locale('es');
                        $cantidadAno = $fechaAntigua->diff($fechaReciente);
                        $year[] = $cantidadAno->y;
                        $month[] = $cantidadAno->m;
                        $day[] = $cantidadAno->d;
                    }
                    $i = 0;
                    return view('admin.users.certificacionTiempo', compact('users', 'year', 'month', 'day', 'i'));
                } catch (\Exception $exception) {
                    Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
                }
            }
            try {

                $userLogueado = auth()->user()->id;
                $users = User::all()->where('active', 1);
                $date = Carbon::now()->locale('es');
                $fechaReciente = Carbon::now();
                foreach ($users  as $user) {
                    $fechaAntigua1 = Carbon::parse($user->fechaIngreso);
                    $fechaAntigua = $fechaAntigua1->locale('es');
                    $cantidadAno = $fechaAntigua->diff($fechaReciente);
                    $year[] = $cantidadAno->y;
                    $month[] = $cantidadAno->m;
                    $day[] = $cantidadAno->d;
                }
                $i = 0;
                return view('admin.users.certificacionTiempo', compact('users', 'year', 'month', 'day', 'i'));
            } catch (\Exception $exception) {
                Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
            }
        }
    }



    public function certificacionLaboralPDF(User $user)
    {

        $date = Carbon::now()->locale('es');
        $fechaReciente = Carbon::now();
        $empresas = Empresa::all();
        foreach ($empresas as $empresa) {
            $nombreEmpresa = $empresa->name;
            $nitEmpresa = $empresa->nit;
            $gerenteEmpresa = $empresa->representative;
            $logoEmpresa = $empresa->logo;
        }

        $fechaAntigua1 = Carbon::parse($user->fechaIngreso);
        $fechaAntigua = $fechaAntigua1->locale('es');
        $cantidadDias = $fechaAntigua->diffInDays($fechaReciente);
        $cantidadMes = $fechaAntigua->diffInMonths($fechaReciente);
        $cantidadAno = $fechaAntigua->diff($fechaReciente);
        $ano = $cantidadAno->m;
        try {
            $codigoQR = QrCode::size(80)->generate(
                "CERTIFICACION LABORAL" . "\n" .
                    "NOMBRE: " . $user->name . "\n" .
                    "LABORANDO: " . "\n" .
                    "EMPRESA: " . $empresa->name . "\n" .
                    "DESDE: " . $user->fechaIngreso . "\n" .
                    "HASTA: " . $fechaReciente . "\n"
            );
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $message = substr($errorMessage, strpos($errorMessage, '$') + 1);
            return back()->with('mensaje', "Falta Informacion sobre: " . $message);
        }
        $pdf = PDF::loadView('admin.users.laboralPDF', compact('user', 'date', 'nombreEmpresa', 'nitEmpresa', 'gerenteEmpresa', 'fechaAntigua', 'cantidadDias', 'cantidadMes', 'cantidadAno', 'codigoQR', 'logoEmpresa'));
        return $pdf->stream();
    }

    public function certificacionTiempoPDF(User $user)
    {
        $date = Carbon::now()->locale('es');
        $fechaReciente = Carbon::now();
        $empresas = Empresa::all();
        foreach ($empresas as $empresa) {
            $nombreEmpresa = $empresa->name;
            $nitEmpresa = $empresa->nit;
            $gerenteEmpresa = $empresa->representative;
            $logoEmpresa = $empresa->logo;
        }
        $fechaAntigua1 = Carbon::parse($user->fechaIngreso);
        $fechaAntigua = $fechaAntigua1->locale('es');
        $cantidadDias = $fechaAntigua->diffInDays($fechaReciente);
        $cantidadMes = $fechaAntigua->diffInMonths($fechaReciente);
        $tiempo = $fechaAntigua->diff($fechaReciente);


        $codigoQR = QrCode::size(80)->generate("CERTIFICACION TIEMPO" . "\n" .
            "NOMBRE: " . $user->name . "\n" .
            "TIEMPO: " . "Años " . $tiempo->y . " Meses " . $tiempo->m . " Dias " . $tiempo->d);

        try {
            $pdf = Pdf::loadView('admin.users.certificacionTiempoPDF', compact('user', 'date', 'nombreEmpresa', 'nitEmpresa', 'gerenteEmpresa', 'fechaAntigua', 'cantidadDias', 'cantidadMes', 'tiempo', 'codigoQR', 'logoEmpresa'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $message = substr($errorMessage, strpos($errorMessage, '$') + 1);
            return back()->with('mensaje', "Falta Informacion sobre: " . $message);
        }

        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return "entro";
        $user = Auth::user();
        $rolActualUsuarioLogueado = $user->getRoleNames()->first();

        if ($rolActualUsuarioLogueado != "Administrador") {
            // dd($rolActualUsuarioLogueado);
            $tipoUsuarios = TipoUsuario::where('nombre', '!=', 'Administrador')
                ->orderBy('id', 'desc')->get();
            $empresas = Empresa::orderBy('id', 'desc');
            return view('admin.users.create', compact('tipoUsuarios', 'empresas'));
        } else {
            // dd($rolActualUsuarioLogueado);
            $tipoUsuarios = TipoUsuario::orderBy('id', 'desc')->get();
            $empresas = Empresa::orderBy('id', 'desc')->get();
            return view('admin.users.create', compact('tipoUsuarios', 'empresas'));
        };
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
            'fechaIngreso' => 'required',
            'name' => 'required',
            'cedula' => 'required',
            'celular' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            'tipoUsuario_id' => 'required',
            'empresa_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create($request->all());

            $nameTipoUsuario = TipoUsuario::findOrFail($user->tipoUsuario_id);
            $idRole = Role::where('name', $nameTipoUsuario->nombre)->first();

            if ($idRole) {
                $user->roles()->sync($idRole->id);
            }

            DB::commit();

            event(new usuarios_widget);
            return redirect()->route('admin.users.index', $user->id)->with('info', 'store');
        } catch (QueryException $e) {
            // Verificar si la excepción es por violación de clave única (correo electrónico duplicado)
            if ($e->errorInfo[1] == 1062) {
                // El código 1062 es específico de MySQL para violación de clave única
                return back()->withInput()->withErrors(['email' => 'El correo electrónico ya está registrado. Por favor, elija otro.']);
            }

            // Si la excepción no es por violación de clave única, puedes manejarla según tus necesidades
            DB::rollBack();
            Log::error("Error UC store: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
            return back()->withInput()->withErrors(['general' => 'Hubo un problema al procesar la solicitud. Por favor, inténtelo de nuevo.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $tipoUsuarios = TipoUsuario::orderBy('id', 'desc');
        $empresas = Empresa::orderBy('id', 'desc');
        return view('admin.users.edit', compact('user', 'tipoUsuarios', 'empresas'));
    }

    public function rol(User $user)
    {
        $userLogueado = Auth::user();
        $rolActualUsuarioLogueado = $userLogueado ->getRoleNames()->first();
        $rolesExcluidos = ['Administrador', 'SuperAdmin']; // Agrega los roles que deseas excluir en este array

        if ($rolActualUsuarioLogueado != "Administrador") {
            // dd($rolActualUsuarioLogueado);
            try {
                $roles = Role::whereNotIn('name', $rolesExcluidos)->get();
                return view('admin.users.rol', compact('user', 'roles'));
            } catch (\Exception $exception) {
                Log::error("Error UC rol: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
            }
        } else {
            try {
                $roles = Role::where('name', '!=', 'SuperAdmin')->get();
                return view('admin.users.rol', compact('user', 'roles'));
            } catch (\Exception $exception) {
                Log::error("Error UC rol: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //VALiDACION FORMULARIO
        $request->validate([
            'fechaIngreso' => 'required',
            'name' => 'required',
            'cedula' => 'required',
            'celular' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            'tipoUsuario_id' => 'required',
            'empresa_id' => 'required',
        ]);
        if ($request->active == 0) {
            $turnos = AsignacionTurno::where('user_id', $user->id)->get();
            $rooms = AsignacionRoom::where('user_id', $user->id)->get();
            $allModels = $turnos->concat($rooms);
            $allModels->each(function ($model) {
                $model->update(['deleted_at' => Carbon::now()]);
            });
        }

        $user->update($request->all());
        return redirect()->route('admin.users.index', $user->id)->with('info', 'update'); //with mensaje de sesion
    }

    public function updateRol(Request $request, User $user)
    {
        try {
            DB::beginTransaction();
            $user->roles()->sync($request->roles);
            DB::commit();
            return redirect()->route('admin.users.index')->with('info', 'updateRol'); //with mensaje de sesion
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error UC updateRol: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return redirect()->route('admin.users.index')->with('info', 'delete');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error UC destroy: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    //METODOS ROSALES PARA LAS FUNCIONADLIDADES
    public function calcularPorcentajePersonal()
    {

        $user = DB::table('user')->count();
        return "el resultado es " . $user;
    }

    public function comprobantePagoPDF(Pago $pago)
    {
        $pagos = Pago::all();
        $pdf = Pdf::loadView('User.comprobantePago', compact('pagos'));
        return $pdf->stream();
    }
}
