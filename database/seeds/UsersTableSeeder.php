<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role;
        $role->name = 'Administrador';
        $role->save();

        $user = new User;
        $user->role_id = $role->id;
        $user->name = 'Alexis';
        $user->surname = 'Maganda';
        $user->email = 'developer2@seadustcancun.com';
        $user->password = Hash::make('developer2');
        $user->email_verified_at = date('Y-m-d H:m:i');
        $user->save();
    }
}
