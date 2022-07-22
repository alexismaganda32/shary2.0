<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;
use App\Http\Requests\CursoRequest;
use DB;

class CursoController extends Controller
{
    // public function __construct()
    // {
    //     $this->cursos = Curso::where('status', 1);
    // }
    public function index(Request $request)
    {
        $name = $request->get('name');
        $datos['cursos'] = Curso::select('id','name','note')
        ->where([
            ['cursos.status', '=', 1],
        ])
        ->searchByFull($request->name)
        ->orderBy('name','asc')
        ->paginate(5);
        return view('Curso.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('curso.form', [
            'action' => 'create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CursoRequest $request)
    {
        DB::beginTransaction();
        $curso = new curso;
        $curso->name = $request->name;
        $curso->note = $request->note;

        if (!$curso->save()) {
            DB::rollBack();
            return response(['errors' => ['curso' => [0 =>'Error al crear el curso.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El curso fue creado correctamente.'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        return view('curso.form', [
            'action' => 'edit',
            'curso' => $curso
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(CursoRequest $request, Curso $curso)
    {
        DB::beginTransaction();
        $curso->name = $request->name;
        $curso->note = $request->note;

        if (!$curso->save()) {
            DB::rollBack();
            return response(['errors' => ['curso' => [0 =>'Error al actualizar un curso.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El curso se actualizó correctamente.'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        $curso -> status = 0;

        if (!$curso->save()) {
            return response(['errors' => ['curso' => [0 =>'Error al eliminar el curso']]], 422);
        }

        return response()->json(['msg' => 'El curso se ha eliminado correctamente.'], 200);

    }
}
