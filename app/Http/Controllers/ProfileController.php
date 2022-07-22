<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class ProfileController extends Controller
{
    public function index()
    {
    	return view('profile');
    }

    public function changePersonalInformation(Request $request)
    {
        DB::beginTransaction();
    	$user = Auth::user();
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'surname' => 'required|max:191',
        ]);

    	if ($validator->fails()) {
            DB::rollBack();
            return response(['errors' => $validator->errors()], 422);
        }

        $user->name = $request->name;
        $user->surname = $request->surname;
        if (!$user->save()) {
            DB::rollBack();
            return response(['errors' => ['user' => [0 =>'Error al actualizar la información.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'Su información se ha actualizado correctamente.'], 200);
    }

    public function changePassword(Request $request)
    {
    	DB::beginTransaction();
    	$user = Auth::user();
    	$validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

    	if ($validator->fails()) {
            DB::rollBack();
            return response(['errors' => $validator->errors()], 422);
        }

        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            DB::rollBack();
            return response(['errors' => ['user' => [0 =>'Su contraseña actual no coincide con la contraseña que proporcionó. Inténtalo de nuevo.']]], 422);
        }
        if(strcmp($request->current_password, $request->new_password) == 0){
            DB::rollBack();
            return response(['errors' => ['user' => [0 =>'La nueva contraseña no puede ser la misma que su contraseña actual. Por favor, elija una contraseña diferente.']]], 422);
        }

        $user->password = Hash::make($request->new_password);
        if (!$user->save()) {
            DB::rollBack();
            return response(['errors' => ['user' => [0 =>'Error al actualizar la información.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'Su contraseña se ha actualizado correctamente.'], 200);
    }
}
