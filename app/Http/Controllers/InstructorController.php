<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\Http\Requests\IntructorRequest;
use Illuminate\Http\Request;
use DB;

class InstructorController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->get('name');
        $datos['instructores'] = Instructor::select('id','name','surnameP','email','telephone')
        ->where([
            ['instructores.status', '=', 1],
        ])
        ->searchByFull($request->name)
        ->orderBy('name','asc')
        ->paginate(15);

        return view('Instructor.index', $datos);
    }

    public function create()
    {
        return view('instructor.form', [
            'action' => 'create'
        ]);
    }

    public function store(IntructorRequest $request)
    {
        DB::beginTransaction();
        $instructor = new instructor;
        $instructor->name = $request->name;
        $instructor->surnameP = $request->surnameP;
        $instructor->surnameM = $request->surnameM;
        $instructor->email = $request->email;
        $instructor->telephone = $request->telephone;

        if (!$instructor->save()) {
            DB::rollBack();
            return response(['errors' => ['instruc' => [0 =>'Error al crear el usuario.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El usuario fue creado correctamente.'], 200);
    }

    public function edit(Instructor $instructor)
    {

        return view('instructor.form', [
            'action' => 'edit',
            'instructor' => $instructor
        ]);
    }

    public function update(IntructorRequest $request, Instructor $instructor)
    {
        DB::beginTransaction();
        $instructor->name = $request->name;
        $instructor->surnameP = $request->surnameP;
        $instructor->surnameM = $request->surnameM;
        $instructor->email = $request->email;
        $instructor->telephone = $request->telephone;

        if (!$instructor->save()) {
            DB::rollBack();
            return response(['errors' => ['instructor' => [0 =>'Error al actualizar la asistencia.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El instructor se actualizó correctamente.'], 200);
    }

    public function destroy(Instructor $instructor)
    {
        $instructor -> status = 0;
        if (!$instructor->save()) {
            return response(['errors' => ['instructor' => [0 =>'Error al eliminar el curso']]], 422);
        }

        return response()->json(['msg' => 'El curso se ha eliminado correctamente.'], 200);
    }
}
