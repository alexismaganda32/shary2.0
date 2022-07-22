<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Role;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->roles = Role::where('status', 1);
    }

    public function index(Request $request)
    {
        $request->flashOnly(['name']);
        $users = User::join('roles', 'users.role_id', '=', 'roles.id')
        ->where([
            ['roles.status', '=', 1],
            ['users.status', '=', 1],
        ])
        ->searchByName($request->name)
        ->select('users.*', 'roles.name as role')
        ->paginate(15);

        return view('User.index', ['users' => $users]);
    }

    public function create()
    {
        if (Auth::user()->id != 1) {
            $this->roles->whereNotIn('id', [1]);
        }

        return view('user.form', [
            'action' => 'create',
            'roles' => $this->roles->get()
        ]);
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        $user = new user;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;

        if (!$user->save()) {
            DB::rollBack();
            return response(['errors' => ['user' => [0 =>'Error al crear el usuario.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El usuario fue creado correctamente. Para acceder deberá verificar su correo electrónico'], 200);
    }

    public function edit(User $user)
    {
        if (Auth::user()->id != 1) {
            $this->roles->whereNotIn('id', [1]);
        }

        return view('user.form', [
            'action' => 'edit',
            'user' => $user,
            'roles' => $this->roles->get()
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if (!$user->save()) {
            DB::rollBack();
            return response(['errors' => ['usuario' => [0 =>'Error al actualizar el usuario.']]], 422);
        }

        DB::commit();
        return response()->json(['msg' => 'El usuario se actualizó correctamente.'], 200);
    }

    public function destroy(User $user)
    {
        $user->status = 0;

        if (!$user->save()) {
            return response(['errors' => ['usuario' => [0 =>'Error al eliminar el usuario.']]], 422);
        }

        return response()->json(['msg' => 'El usuario se ha eliminado correctamente.'], 200);
    }
}
