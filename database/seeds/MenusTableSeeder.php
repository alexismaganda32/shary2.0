<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//** ICONOS DE Font Awesome Free 5.10.2 **//
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Menu::query()->truncate();

        $menu1 = Menu::create([
        	'name' => 'Administrador',
        	'slug' => 'menu1',
            'icon' => 'fas fa-user-lock',
        	'father' => 0,
        	'order' => 1
        ]);
        Menu::create([
        	'name' => 'Roles',
        	'slug' => 'menu-1.1',
        	'module_id' => 1,
        	'father' => $menu1->id,
        	'order' => 1
        ]);
        Menu::create([
        	'name' => 'Usuarios',
        	'slug' => 'menu-1.2',
        	'module_id' => 2,
        	'father' => $menu1->id,
        	'order' => 2
        ]);
        Menu::create([
            'name' => 'Logs',
            'slug' => 'menu-1.3',
            'module_id' => 3,
            'father' => $menu1->id,
            'order' => 3
        ]);


        $menu2 = Menu::create([
            'name' => 'Catalogos',
            'slug' => 'menu2',
            'icon' => 'fas fa-address-book',
            'father' => 0,
            'order' => 1
        ]);
        Menu::create([
            'name' => 'Departamentos',
            'slug' => 'menu-2.1',
            'module_id' => 4,
            'father' => $menu2->id,
            'order' => 4
        ]);
        Menu::create([
            'name' => 'Puestos',
            'slug' => 'menu-2.2',
            'module_id' => 5,
            'father' => $menu2->id,
            'order' => 5
        ]);
        Menu::create([
            'name' => 'Razon Social',
            'slug' => 'menu-2.3',
            'module_id' => 6,
            'father' => $menu2->id,
            'order' => 6
        ]);
        Menu::create([
            'name' => 'Anfitrion',
            'slug' => 'menu-2.4',
            'module_id' => 7,
            'father' => $menu2->id,
            'order' => 7
        ]);
        Menu::create([
            'name' => 'Instructor',
            'slug' => 'menu-2.5',
            'module_id' => 10,
            'father' => $menu2->id,
            'order' => 10
        ]);
        $menu3 = Menu::create([
            'name' => 'Cursos',
            'slug' => 'menu3',
            'icon' => 'fas fa-chalkboard-teacher',
            'father' => 0,
            'order' => 1
        ]);
        Menu::create([
            'name' => 'Lista de cursos',
            'slug' => 'menu-3.1',
            'module_id' => 8,
            'father' => $menu3->id,
            'order' => 8
        ]);

        Menu::create([
            'name' => 'Asistencia',
            'slug' => 'menu-3.2',
            'module_id' => 9,
            'father' => $menu3->id,
            'order' => 9
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
