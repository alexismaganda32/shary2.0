<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$name = $request->get('name');
        $datos['departments'] = Department::select('id','name','keycode')
        ->where([
            ['departments.status', '=', 1],
        ])
        ->searchByFull($request->name)
        ->orderBy('name','asc')
        ->paginate(15);
        return view('Department.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.form', [
            'action' => 'create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        DB::beginTransaction();
        $department = new department;
        $department->name = $request->name;
        $department->keycode = $request->keycode;

        if (!$department->save()) {
            DB::rollBack();
            return response(['errors' => ['department' => [0 =>'Error al crear el departamento.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El departamento fue creado correctamente.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('department.form', [
            'action' => 'edit',
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        DB::beginTransaction();
        $department->name = $request->name;
        $department->keycode = $request->keycode;

        if (!$department->save()) {
            DB::rollBack();
            return response(['errors' => ['departamento' => [0 =>'Error al actualizar el departamento.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El departamento se actualizó correctamente.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
    	$department -> status = 0;

		if (!$department->save()) {
            return response(['errors' => ['departamento' => [0 =>'Error al eliminar el departamento.']]], 422);
        }

        return response()->json(['msg' => 'El departamento se ha eliminado correctamente.'], 200);
    }
}
