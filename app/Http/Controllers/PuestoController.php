<?php

namespace App\Http\Controllers;

use App\Puesto;
use Illuminate\Http\Request;
use App\Http\Requests\PuestoRequest;
use DB;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $datos['puestos'] = Puesto::select('id','name','keycode')
        ->where([
            ['puestos.status', '=', 1],
        ])
        ->searchByFull($request->name)
        ->orderBy('name','asc')
        ->paginate(5);
        return view('Puesto.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('puesto.form', [
            'action' => 'create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PuestoRequest $request)
    {

        DB::beginTransaction();
        $puesto = new puesto;
        $puesto->name = $request->name;
        $puesto->keycode = $request->keycode;

        if (!$puesto->save()) {
            DB::rollBack();
            return response(['errors' => ['puesto' => [0 =>'Error al crear el puesto.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El puesto fue creado correctamente.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function show(Puesto $puesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Puesto $puesto)
    {
        return view('puesto.form', [
            'action' => 'edit',
            'puesto' => $puesto
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(PuestoRequest $request, Puesto $puesto)
    {
        DB::beginTransaction();
        $puesto->name = $request->name;
        $puesto->keycode = $request->keycode;

        if (!$puesto->save()) {
            DB::rollBack();
            return response(['errors' => ['puesto' => [0 =>'Error al actualizar el puesto.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El puesto se actualizó correctamente.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puesto $puesto)
    {
        $puesto-> status = 0;

        if (!$puesto->save()) {
            return response(['errors' => ['puesto' => [0 =>'Error al eliminar el puesto.']]], 422);
        }

        return response()->json(['msg' => 'El puesto se ha eliminado correctamente.'], 200);
    }
}
