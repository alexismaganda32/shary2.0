<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Permission;
use App\Module;
use DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->modules = Module::orderBy('id')->get();
    }

    public function index(Request $request)
    {
        $request->flashOnly(['name']);
        $roles = Role::where('status', 1)
        ->searchByName($request->name)
        ->paginate(15);
        return view('Role.index', [ 'roles' => $roles ]);
    }

    public function create()
    {
        return view('role.form', [
            'action' => 'create',
            'modules' => $this->modules,
        ]);
    }

    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        $role = new Role;
        $role->name = $request->name;

        if (!$role->save()) {
            DB::rollBack();
            return response(['errors' => ['role' => [0 =>'Error al crear el role.']]], 422);
        }

        foreach ($request->permissions as $key => $permission) {
            $newPermission = new Permission;
            $newPermission->read = $permission['read'];
            $newPermission->create = $permission['create'];
            $newPermission->edit = $permission['edit'];
            $newPermission->destroy = $permission['destroy'];
            $newPermission->module_id = $permission['module_id'];
            $newPermission->role_id = $role->id;

            if (!$newPermission->save()) {
                DB::rollBack();
                return response(['errors' => ['role' => [0 =>'Error al crear los permisos.']]], 422);
            }
        }

        DB::commit();
        return response(['msg' => 'El role fue creado correctamente.'], 200);
    }

    public function edit(Role $role)
    {
        $data = array();
        foreach ($this->modules as $keyM => $module) {
            $data[$keyM]['module_id'] = $module->id;
            $data[$keyM]['alias'] = $module->alias;

            $permission = Permission::where([
                ['role_id', '=', $role->id],
                ['module_id', '=', $module->id]
            ])->first();

            $data[$keyM]['read'] = $permission ? $permission->read : 0;
            $data[$keyM]['create'] = $permission ? $permission->create : 0;
            $data[$keyM]['edit'] = $permission ? $permission->edit : 0;
            $data[$keyM]['destroy'] = $permission ? $permission->destroy : 0;
        }

        $role->permissions = $data;
        return view('role.form', [
            'action' => 'edit',
            'role' => $role,
            'modules' => $this->modules,
        ]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->name = $request->name;
        if (!$role->save()) {
            DB::rollBack();
            return response(['errors' => ['role' => [0 =>'Error al actualizar el role.']]], 422);
        }

        foreach ($request->permissions as $key => $permission) {
            $getPermission = Permission::where([
                ['permissions.role_id', '=', $role->id],
                ['permissions.module_id', '=', $permission['module_id']]
            ])->first();

            $getPermission = $getPermission ? $getPermission : new Permission;
            $getPermission->read = $permission['read'];
            $getPermission->create = $permission['create'];
            $getPermission->edit = $permission['edit'];
            $getPermission->destroy = $permission['destroy'];
            $getPermission->module_id = $permission['module_id'];
            $getPermission->role_id = $role->id;

            if (!$getPermission->save()) {
                DB::rollBack();
                return response(['errors' => ['role' => [0 =>'Error al actualizar los permisos.']]], 422);
            }
        }

        return response(['msg' => 'El role se actualizó correctamente.'], 200);
    }
    
    public function destroy(Role $role)
    {
        $role->status = 0;

        if (!$role->save()) {
            return response(['errors' => ['role' => [0 =>'Error al eliminar el role.']]], 422);
        }

        return response(['msg' => 'El role se ha eliminado correctamente.'], 200);
    }
}
