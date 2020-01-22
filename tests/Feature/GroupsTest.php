<?php

namespace Tests\Feature;

use App\User;
use App\Group;
use Tests\TestCase;
use UserTableSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupsTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInitialSeed()
    {
        $groups = file_get_contents(__DIR__ . "/json/initialSeed.json");
        $user = User::findOrFail(7)->first();
        $response = $this->json('POST', '/api/syncGroups?api_token='.$user->api_token, ['groups' => $groups]);


        $response->assertOk();
        $root = Group::findOrFail(1);
        $child = Group::findOrFail(2);
        $leaf_parent = Group::findOrFail(4);
        $leaf = Group::findOrFail(5);

        $this->assertTrue($root->isRoot());
        $this->assertTrue($child->isChildOf($root));
        $this->assertTrue($leaf->isChildOf($leaf_parent));
    }

    public function testMoveLeaf()
    {
        $groups = file_get_contents(__DIR__ . "/json/moveLeaf.json");

        $user = User::findOrFail(7)->first();
        $response = $this->json('POST', '/api/syncGroups?api_token='.$user->api_token, ['groups' => $groups]);


        $response->assertOk();
        $leaf = Group::findOrFail(5);
        $leaf_parent = Group::findOrFail(3);

        $this->assertTrue($leaf->isChildOf($leaf_parent));
        
    }
    
    public function testLeafDelete()
    {
        $groups = file_get_contents(__DIR__ . "/json/deleteLeaf.json");

        $user = User::findOrFail(7)->first();
        $response = $this->json('POST', '/api/syncGroups?api_token='.$user->api_token, ['groups' => $groups]);

        $response->assertOk();
        $this->assertSoftDeleted(
            'groups', [
            'id' => 5,
            ]
        );
    }

    public function testSubtreeDelete()
    {
        $groups = file_get_contents(__DIR__ . "/json/subTreeDelete.json");

        $user = User::findOrFail(7)->first();
        $response = $this->json('POST', '/api/syncGroups?api_token='.$user->api_token, ['groups' => $groups]);
        // var_dump($response);

        $response->assertOk();
        $this->assertSoftDeleted(
            'groups', [
            'id' => 3,
            ]
        );
        $this->assertSoftDeleted(
            'groups', [
            'id' => 4,
            ]
        );

        $root = Group::findOrFail(1);
        $child = Group::findOrFail(2);

        $this->assertTrue($root->isRoot());
        $this->assertTrue($child->isChildOf($root));
    }

    public function testCreateSubTree()
    {
        $groups = file_get_contents(__DIR__ . "/json/createSubTree.json");

        $user = User::findOrFail(7)->first();
        $response = $this->json('POST', '/api/syncGroups?api_token='.$user->api_token, ['groups' => $groups]);

        $response->assertOk();

        $one = Group::findOrFail(6);
        $root = Group::findOrFail(1);

        $two = Group::findOrFail(7);
        $five = Group::findOrFail(9);
        
        $four = Group::findOrFail(8);
        $six = Group::findOrFail(11);
        $three = Group::findOrFail(10);

        $this->assertTrue($one->isChildOf($root));
        $this->assertTrue($five->isChildOf($four));
        $this->assertTrue($two->isChildOf($one));
        $this->assertTrue($six->isChildOf($three));
    }

    public function testMoveSubTree()
    {
        $groups = file_get_contents(__DIR__ . "/json/moveSubTree.json");

        $user = User::findOrFail(7)->first();
        $response = $this->json('POST', '/api/syncGroups?api_token='.$user->api_token, ['groups' => $groups]);

        $response->assertOk();

 
        $root = Group::findOrFail(1);
        $two = Group::findOrFail(7);
        
        $this->assertTrue($two->isChildOf($root));
    }

    public function testAddMoveSubTree()
    {
        $groups = file_get_contents(__DIR__ . "/json/addMoveSubTree.json");

        $user = User::findOrFail(7)->first();
        $response = $this->json('POST', '/api/syncGroups?api_token='.$user->api_token, ['groups' => $groups]);

        $response->assertOk();

 
        $new4 = Group::findOrFail(15);
        $new3 = Group::findOrFail(14);
        $new1 = Group::findOrFail(12);
        $four = Group::findOrFail(8);
        $six = Group::findOrFail(11);

        $this->assertTrue($new4->isChildOf($new3));
        $this->assertTrue($four->isChildOf($six));
        $this->assertTrue($new1->isSiblingOf($new3));
    }
}
