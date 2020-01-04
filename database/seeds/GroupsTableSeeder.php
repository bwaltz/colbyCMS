<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Add groups
         */
        DB::table('groups')->insert(
            [
            'name' => 'WPcommeditorGRP',
            'description' => 'Active Directory Group - changes to this group need to be made in CARS!',
            'type' => 'AD',
            ]
        );

        DB::table('groups')->insert(
            [
            'name' => 'WPlibaadminGRP',
            'description' => 'Active Directory Group - changes to this group need to be made in CARS!',
            'type' => 'AD',
            ]
        );

        DB::table('groups')->insert(
            [
            'name' => 'WPartmeditorGRP',
            'description' => 'Active Directory Group - changes to this group need to be made in CARS!',
            'type' => 'AD',
            ]
        );

        /**
         * Add users to groups
         */
        DB::table('group_user')->insert(
            [
            'user_id' => '1',
            'group_id' => '1',
            ]
        );
        DB::table('group_post')->insert(
            [
            'post_id' => '1',
            'group_id' => '1',
            ]
        );
        // DB::table('group_user')->insert(
        //     [
        //     'user_id' => '5',
        //     'group_id' => '1',
        //     ]
        // );
        // DB::table('group_user')->insert(
        //     [
        //     'user_id' => '4',
        //     'group_id' => '2',
        //     ]
        // );
        // DB::table('group_user')->insert(
        //     [
        //     'user_id' => '3',
        //     'group_id' => '3',
        //     ]
        // );
    }
}
