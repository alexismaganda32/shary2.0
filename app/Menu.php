<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;
use App\Module;
use Auth;

class Menu extends Model
{
	protected $hidden = [
	 	'created_at', 'updated_at',
    ];
    
    public static function menuByPermissions()
    {
        $permissions = Permission::join('modules', 'permissions.module_id', '=', 'modules.id')
            ->where('permissions.role_id', Auth::user()->role_id)
            ->where('read', 1)
            ->pluck('permissions.module_id');

        $menus = Menu::where('father', 0)->orderby('order')->get()->toArray();

        foreach ($menus as $key => $menu) {
            if ($menu['module_id']) {
                if (in_array($menu['module_id'], json_decode($permissions))) {
                    $module = Module::find($menu['module_id']);
                    $menus[$key]['path'] = $module->path;
                }else {
                    unset($menus[$key]);
                }
            }
        }

        foreach ($menus as $key => $menu) {
            $submenus = Menu::join('modules', 'menus.module_id', '=', 'modules.id')
            ->where('father', $menu['id'])
            ->whereIn('module_id', $permissions)
            ->orderby('order')
            ->select('menus.id', 'menus.name', 'modules.path')
            ->get()
            ->toArray();

            if ($submenus) {
                $menus[$key]['submenus'] = $submenus;
            }
        }

        foreach ($menus as $keyMenu => $menu) {
            if (!$menus[$keyMenu]['module_id']) {
                if (!isset($menus[$keyMenu]['submenus'])) {
                    unset($menus[$keyMenu]);
                }
            }
        }

        return $menus;
    }
}
