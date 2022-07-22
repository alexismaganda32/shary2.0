<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/********************** IMPORTANTE *********************/
        /****** SIEMPRE AGREGAR EL MODULO NUEVO
        /****** AL ULTIMO DEL ARRAY
        /********************** IMPORTANTE *********************/

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Module::query()->truncate();

        $array = array(
            [
                'module' => 'role', 'alias' => 'Roles' // id => 1
            ],
            [
                'module' => 'user', 'alias' => 'Usuarios' // id => 2
            ],
            [
                'module' => 'activitylog', 'alias' => 'Logs' // id => 3
            ],
            [
                'module' => 'department', 'alias' => 'Departamentos' // id => 4
            ],
            [
                'module' => 'puesto', 'alias' => 'Puestos' // id => 5
            ],
            [
                'module' => 'social', 'alias' => 'Razon Social' // id => 6
            ],
            [
                'module' => 'host', 'alias' => 'Anfitrion' // id => 7
            ],
            [
                'module' => 'curso', 'alias' => 'Lista de cursos' // id => 8
            ],
            [
                'module' => 'assistance', 'alias' => 'Asistencia' // id => 9
            ],
            [
                'module' => 'instructor', 'alias' => 'Instructor' // id => 10
            ],
    	);

    	foreach ($array as $key => $value) {
    		Module::create([
    			'name' => strtoupper($value['module']),
                'alias' => $value['alias'],
    			'path' => $value['module']
    		]);
    	}

        //SE ELIMINAN LOS PERMISOS DEL ADMINISTRADOR Y SE LE DAN PERMISOS PARA LOS NUEVOS MODULeS
        $modules = Module::all();
        $admin = Permission::where('role_id', 1)->delete();
        foreach ($modules as $key => $module) {
            Permission::create([
                'read' => 1,
                'create' => 1,
                'destroy' => 1,
                'edit' => 1,
                'module_id' => $module->id,
                'role_id' => 1
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
