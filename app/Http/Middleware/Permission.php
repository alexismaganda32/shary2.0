<?php

namespace App\Http\Middleware;

use Closure;
use App\Module;
use App\User;
use App\Permission as Perm;
use Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role_id = Auth::user()->role_id;
        if(!$role_id){
            return redirect('/login')->with('message-error','Debes iniciar sesión');
        }
        /**********************************************************/
        $path = $request->path(); // "pais"
        $name = $request->route()->getName();// "pais.index"

        if ($request->name_current) {
            $name = $request->name_current;
        }

        $name = explode('.', $name);
        if(count($name) == 2){
            list($pathModule,$method) = $name;
        }else {
            if ($request->ajax()) {
                return response(['errors' => ['permission' => [0 =>'Route Name no reconocido.']]], 422);
            }
            abort(404);
        }

        $module = Module::where('path', $pathModule)->first();
        if (!$module) {
            if ($request->ajax()) {
                return response(['errors' => ['permission' => [0 =>'Modulo no encontrado.']]], 422);
            }
            abort(404);
        }

        if ($role_id == 0) { //ACCESO PARA TODO AL SUPERADMINISTRADOR
            return $next($request);
        }

        $permission = Perm::where('role_id', $role_id)->where('module_id', $module->id)->first();
        if (!$permission) {
            return redirect('/')->with('message-error', 'No se han asignado permisos para el usuario: '. Auth::user()->name .'.');
        }

        $msg = '';
        switch ($method) {
            case 'index':
                if ($permission->read == 1) {
                    return $next($request);
                }
                $msg = 'PARA VER';
                break;
            case 'store':
            case 'create':
                if ($permission->create == 1) {
                    return $next($request);
                }
                $msg = 'PARA CREAR';
                break;
            case 'edit':
            case 'update':
                if ($permission->edit == 1) {
                    return $next($request);
                }
                $msg = 'PARA EDITAR';
                break;
            case 'destroy':
                if ($permission->destroy == 1) {
                    return $next($request);
                }
                $msg = 'PARA ELIMINAR';
                break;
            default:
                if ($request->ajax()) {
                    return response(['errors' => ['permission' => [0 =>'Proceso desconocido comuníquese con el administrador (METHOD).']]], 422);
                }
                return redirect('/')->with('message-error', 'Proceso desconocido comuníquese con el administrador (METHOD)');
                break;
        }
        
        $msg = 'No se han asignado permisos '. $msg .' en el module de: '. $module->name .'.';
        if ($request->ajax()) {
            return response(['errors' => ['permission' => [0 => $msg]]], 422);
        }
        if ($permission->read == 1) {
            return redirect('/'. $module->path)->with('message-error', $msg);
        }
        
        return redirect('/')->with('message-error', $msg);
    }
}
