<?php
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'testSuper';
        $user->email = 'testsuper@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 1;
        $user->save();
        $user->roles()->attach(Role::where('name', 'admin')->first());
        
        $user = new User;
        $user->name = 'testAdmin';
        $user->email = 'testadmin@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 0;
        $user->save();
        $user->roles()->attach(Role::where('name', 'admin')->first());
        
        $user = new User;
        $user->name = 'testEditor';
        $user->email = 'testeditor@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 0;
        $user->save();
        $user->roles()->attach(Role::where('name', 'editor')->first());
        
        $user = new User;
        $user->name = 'testAuthor';
        $user->email = 'testauthor@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 0;
        $user->save();
        $user->roles()->attach(Role::where('name', 'author')->first());
        
        $user = new User;
        $user->name = 'testUser';
        $user->email = 'testuser@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 0;
        $user->save();
        $user->roles()->attach(Role::where('name', 'user')->first());

    }
}
