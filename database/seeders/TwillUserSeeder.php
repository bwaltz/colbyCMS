<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use A17\Twill\Models\User;

class TwillUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => "Admin",
            'email' => 'webmaster@colby.edu',
            'role' => 'SUPERADMIN',
            'published' => true,
        ]);

        $user->password = Hash::make('123456');
        $user->save();
    }
}
