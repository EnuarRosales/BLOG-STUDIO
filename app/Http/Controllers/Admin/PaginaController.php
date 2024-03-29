<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pagina;
use App\Models\TipoMonedaPagina;
use Illuminate\Http\Request;

class PaginaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginas = Pagina::orderBy('id','desc')->paginate();
        return view('admin.paginas.index',compact('paginas'));
        // $paginas = Pagina::all();
        // return $paginas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $tipoMonedapaginas = TipoMonedaPagina::orderBy('id','desc');
        return view('admin.paginas.create');
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
        'nombre'=>'required',
        'valor' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        'moneda'=>'required',

    ]);
    $pagina= Pagina::create($request->all());
    return redirect()->route('admin.paginas.index',$pagina->id)->with('info','store');

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
    public function edit(Pagina $pagina)
    {
        // $tipoMonedapaginas = TipoMonedaPagina::orderBy('id','desc');
        // return $pagina;
        return view('admin.paginas.edit',compact('pagina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Pagina $pagina)
    {
        //VALLIDACION DE FORMULARIOS
        $request->validate([
            'nombre'=>'required',
            'valor' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'], 
            'moneda'=>'required',

        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $pagina->update($request->all());
        return redirect()->route('admin.paginas.index',$pagina->id)->with('info','update');//with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagina $pagina)
    {
        $pagina->delete();
        return redirect()->route('admin.paginas.index')->with('info','delete');
    }
}
