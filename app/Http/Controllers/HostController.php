<?php

namespace App\Http\Controllers;

use App\Host;
use Illuminate\Http\Request;
use App\Http\Requests\HostRequest;
use App\ReasonSocial;
use App\Department;
use App\Puesto;
use DB;

class HostController extends Controller
{
    public function __construct()
    {
        $this->reason_socials = ReasonSocial::where('status', 1);
        $this->departments = Department::where('status', 1);
        $this->puestos = Puesto::where('status', 1);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->flashOnly(['name']);
        $hosts=Host::join('reason_socials','reason_socials.id','=','hosts.reason_social_id')
        ->join('departments','departments.id','=','hosts.department_id')
        ->join('puestos','puestos.id','=','hosts.puesto_id')
        ->where([
            ['reason_socials.status', '=', 1],
            ['departments.status', '=', 1],
            ['puestos.status', '=', 1],
            ['hosts.status', '=', 1],
        ])
        ->select('hosts.*','reason_socials.name as social','departments.name as department','puestos.name as puesto')
        ->searchByName($request->name)
        ->paginate(15);

        return view('Host.index', ['hosts' => $hosts]);

        /*$buscar = $request->get('Buscar');
        $tipo = $request->get('tipo');
        $variableurl=[
            'tipo' => $tipo,
            'Buscar' => $buscar
        ];
        $datos['department'] = Department::buscar($tipo,$buscar)
        ->paginate(5)
        ->appends($variableurl);
        return view('Department.index', $datos);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('host.form', [
            'action' => 'create',
            'reason_socials' => $this->reason_socials->get(),
            'departments' => $this->departments->get(),
            'puestos' => $this->puestos->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HostRequest $request)
    {
        DB::beginTransaction();
        $host = new host;
        $host->name = $request->name;
        $host->surnameM = $request->surnameM;
        $host->surnameP = $request->surnameP;
        $host->NC = $request->NC;
        $host->house = $request->house;
        $host->mobile = $request->mobile;
        $host->CE = $request->CE;
        $host->email = $request->email;
        $host->reason_social_id = $request->reason_social_id;
        $host->NSS = $request->NSS;
        $host->department_id = $request->department_id;
        $host->puesto_id = $request->puesto_id;

        if (!$host->save()) {
            DB::rollBack();
            return response(['errors' => ['host' => [0 =>'Error al crear el anfitrion.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El anfitrion fue creado correctamente.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function show(Host $host)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function edit(Host $host)
    {
        return view('host.form', [
            'action' => 'edit',
            'host' => $host,
            'reason_socials' => $this->reason_socials->get(),
            'departments' => $this->departments->get(),
            'puestos' => $this->puestos->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function update(HostRequest $request, Host $host)
    {
        DB::beginTransaction();
        $host->name = $request->name;
        $host->surnameP = $request->surnameP;
        $host->surnameM = $request->surnameM;
        $host->NC = $request->NC;
        $host->house = $request->house;
        $host->mobile = $request->mobile;
        $host->CE = $request->CE;
        $host->email = $request->email;
        $host->reason_social_id = $request->reason_social_id;
        $host->NSS = $request->NSS;
        $host->department_id = $request->department_id;
        $host->puesto_id = $request->puesto_id;

        if (!$host->save()) {
            DB::rollBack();
            return response(['errors' => ['Anfitrion' => [0 =>'Error al actualizar el anfitrion.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El anfitrion se actualizó correctamente.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function destroy(Host $host)
    {
        $host -> status = 0;

        if (!$host->save()) {
            return response(['errors' => ['Anfitrion' => [0 =>'Error al eliminar a un anfitrion.']]], 422);
        }

        return response()->json(['msg' => 'El anfitrion se ha eliminado correctamente.'], 200);
    }
}
