<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_regular_user = new Role;
        $role_regular_user->name = 'admin';
        $role_regular_user->label = 'Site Admin';
        $role_regular_user->description = 'A site administrator';
        $role_regular_user->save();

        $role_admin_user = new Role;
        $role_admin_user->name = 'editor';
        $role_admin_user->label = 'Editor';
        $role_admin_user->description = 'An content editor';
        $role_admin_user->save();

        $role_admin_user = new Role;
        $role_admin_user->name = 'author';
        $role_admin_user->label = 'Author';
        $role_admin_user->description = 'An content author';
        $role_admin_user->save();
        
        $role_admin_user = new Role;
        $role_admin_user->name = 'user';
        $role_admin_user->label = 'User';
        $role_admin_user->description = 'A un-privileged user';
        $role_admin_user->save();
    }
}
