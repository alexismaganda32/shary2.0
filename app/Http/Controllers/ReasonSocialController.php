<?php

namespace App\Http\Controllers;

use App\ReasonSocial;
use Illuminate\Http\Request;
use App\Http\Requests\SocialRequest;
use DB;

class ReasonSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');

        $datos['reason_socials'] = ReasonSocial::select('id','name','note')
        ->where([
            ['reason_socials.status', '=', 1],
        ])
        ->searchByFull($request->name)
        ->orderBy('name','asc')
        ->paginate(5);
        return view('ReasonSocial.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reasonsocial.form', [
            'action' => 'create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialRequest $request)
    {
        DB::beginTransaction();
        $social = new reasonsocial;
        $social->name = $request->name;
        $social->note = $request->note;

        if (!$social->save()) {
            DB::rollBack();
            return response(['errors' => ['social' => [0 =>'Error al crear la razon social.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'La razon social fue creada correctamente.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReasonSocial  $social
     * @return \Illuminate\Http\Response
     */
    public function show(ReasonSocial $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReasonSocial  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(ReasonSocial $social)
    {
        return view('reasonsocial.form', [
            'action' => 'edit',
            'social' => $social
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReasonSocial  $social
     * @return \Illuminate\Http\Response
     */
    public function update(SocialRequest $request, ReasonSocial $social)
    {
        DB::beginTransaction();
        $social->name = $request->name;
        $social->note = $request->note;

        if (!$social->save()) {
            DB::rollBack();
            return response(['errors' => ['Razon social' => [0 =>'Error al actualizar la razon social.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'La razon social se actualizó correctamente.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReasonSocial  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReasonSocial $social)
    {
        $social -> status = 0;

        if (!$social->save()) {
            return response(['errors' => ['Razon social' => [0 =>'Error al eliminar la razon social']]], 422);
        }

        return response()->json(['msg' => 'La razon social se ha eliminado correctamente.'], 200);
    }
}
