<?php

namespace App\Http\Controllers;

use App\Assistance;
use Illuminate\Http\Request;
use App\Http\Requests\AssistanceRequest;
use App\Host;
use App\Curso;
use App\Instructor;
use DB;
use App\AssistanceDetail;
use Illuminate\Foundation\Console\Presets\React;

class AssistanceController extends Controller
{
    public function __construct()
    {
        $this->instructores = Instructor::where('status', 1);
        $this->hosts = Host::where('status', 1);
        $this->cursos = Curso::where('status', 1);
    }

    public function index(Request $request)
    {
        $request->flashOnly(['name']);

        $assistances=Assistance::join('cursos','cursos.id','=','assistances.curso_id')
        ->join('instructores','instructores.id','=','assistances.instructor_id')
        ->where([
            ['instructores.status', '=', 1],
            ['cursos.status', '=', 1],
            ['assistances.status', '=', 1],
        ])
        ->searchByName($request->name)
        ->select('assistances.*','cursos.name as curso','instructores.name as instructor')
        ->paginate(15);

        return view('Assistance.index', ['assistances' => $assistances]);
    }

    public function create()
    {
        return view('assistance.form', [
            'action' => 'create',
            'hosts' => $this->hosts->get(),
            'cursos' => $this->cursos->get(),
            'instructores' => $this->instructores->get()
        ]);
    }

    public function store(AssistanceRequest $request)
    {
        DB::beginTransaction();
        $assistance = new Assistance;
        $assistance->instructor_id = $request->instructor_id;
        $assistance->curso_id = $request->curso_id;
        $assistance->date = date('Y-m-d', strtotime($request->date));
        $assistance->hour = $request->hour;

        if (!$assistance->save()) {
            DB::rollBack();
            return response(['errors' => ['assistance' => [0 =>'Error al crear una asistencia.']]], 422);
        }

        foreach ($request->hosts as $keyH => $host) {
            $detail = new AssistanceDetail;
            $detail->assistance_id = $assistance->id;
            $detail->host_id = $host;

            if (!$detail->save()) {
                DB::rollBack();
                return response(['errors' => ['assistance' => [0 =>'Error al crear una asistencia.']]], 422);
            }
        }

        DB::commit();
        return response()->json(['msg' => 'La asistencia fue creada correctamente.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function show(Assistance $assistance)
    {
        //
    }

    /**fffff
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function edit(Assistance $assistance)
    {
        return view('assistance.form', [
            'action' => 'edit',
            'assistance' => $assistance,
            'hosts' => $this->hosts->get(),
            'cursos' => $this->cursos->get(),
            'instructores' => $this->instructores->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function update(AssistanceRequest $request, Assistance $assistance)
    {
        DB::beginTransaction();
        $assistance->instructor_id = $request->instructor_id;
        // $assistance->host_id = $request->host_id;
        $assistance->curso_id = $request->curso_id;
        $assistance->date = date('Y-m-d', strtotime($request->date));
        $assistance->hour = $request->hour;
        if (!$assistance->save()) {
            DB::rollBack();
            return response(['errors' => ['assistance' => [0 =>'Error al actualizar la asistencia.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'La asistencia se actualizó correctamente.'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assistance $assistance)
    {
        $assistance -> status = 0;


        if (!$assistance->save()) {
            return response(['errors' => ['assistance' => [0 =>'Error al eliminar una asistencia.']]], 422);
        }

        return response()->json(['msg' => 'La asistencia se ha eliminado correctamente.'], 200);

    }

    public function details(Request $request) {
        $asis = Assistance::join('instructores', 'assistances.instructor_id', '=', 'instructores.id')
            ->join('cursos', 'assistances.curso_id', '=', 'cursos.id')
            ->where('assistances.id', '=', $request->assistance_id)
            ->select(
                'assistances.id',
                'assistances.date',
                'assistances.hour',
                'assistances.note',
                'instructores.name as ins_name',
                'instructores.surnameP as ins_surnameP',
                'instructores.surnameM as ins_surnameM',
                'instructores.telephone as ins_telephone',
                'cursos.name as cur_name')
            ->first();

        $host = AssistanceDetail::join('hosts', 'assistance_details.host_id', '=', 'hosts.id')
            ->where('assistance_details.assistance_id', '=', $request->assistance_id)
            ->select(
                'hosts.id',
                'hosts.name',
                'hosts.surnameP',
                'hosts.surnameM'
                )
            ->get();

        $asis->hosts = array();
        $asis->hosts = $host;

        return view('assistance.detail',['host'=>$asis],['asis'=>$host]);
        return  ['host' =>$host];

        // $data = [
        //     'asis' => $asis,s
        //     'hosts' => $host,
        // ];
        // dd($data);
        // return view('assistance.detail',['data'=>$data]);

    }


}
