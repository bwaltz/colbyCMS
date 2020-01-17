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
        $user->api_token = str_random(60);
        $user->save();
        $user->assignRole('superAdmin');
        
        $user = new User;
        $user->name = 'testAdmin';
        $user->email = 'testadmin@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 0;
        $user->api_token = str_random(60);
        $user->save();
        $user->assignRole('admin');
        
        $user = new User;
        $user->name = 'testEditor';
        $user->email = 'testeditor@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 0;
        $user->api_token = str_random(60);
        $user->save();
        $user->assignRole('editor');
        
        $user = new User;
        $user->name = 'testAuthor';
        $user->email = 'testauthor@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 0;
        $user->api_token = str_random(60);
        $user->save();
        $user->assignRole('author');
        
        $user = new User;
        $user->name = 'testStudent';
        $user->email = 'teststudent@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 0;
        $user->save();
        $user->assignRole('student');

        $user = new User;
        $user->name = 'testAlumni';
        $user->email = 'testalumni@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 0;
        $user->api_token = str_random(60);
        $user->save();
        $user->assignRole('alumni');

        $user = new User;
        $user->name = 'scripts';
        $user->email = 'webmaster@test.com';
        $user->password = bcrypt('1234');
        $user->super_admin = 0;
        $user->api_token = str_random(60);
        $user->save();
        $user->assignRole('admin');

    }
}
