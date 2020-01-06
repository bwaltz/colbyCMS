<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{

    protected $permissions = [
        "admin.view.posts",
        "admin.view.own.posts",
        "admin.view.other.posts",
        "admin.edit.other.posts",
        "admin.edit.own.posts",
        "admin.delete.own.posts",
        "admin.delete.other.posts",
        "admin.delete.posts", // <--fix this
        "admin.create.posts",
        "admin.view.settings",
        "admin.duplicate.posts",
        "admin.publish.posts",
        "admin.archive.posts",
        "admin.view.post.revisions",
        "admin.edit.own.pages",
        "admin.view.pages",
        "admin.create.pages",
        "admin.edit.other.pages",
        "admin.duplicate.pages",
        "admin.delete.pages",
        "admin.publish.pages",
        "admin.archive.pages",
        "admin.view.page.revisions",
        "admin.create.media",
        "admin.view.media",
        "admin.edit.own.media",
        "admin.edit.other.media",
        "admin.delete.media",
        "admin.create.users",
        "admin.edit.users",
        "admin.view.users",
        "admin.archive.users",
        "admin.delete.users",
        "admin.add.dashboard.cards",
        "admin.delete.dashboard.cards",
        "student.view.posts",
        "student.create.posts",
        "student.edit.own.posts",
        "student.edit.other.posts",
        "student.archive.posts",
        "student.view.pages",
        "student.create.comment",
        "student.edit.comment",
        "student.view.alumni.posts",
        "student.view.alumni.pages",
        "student.delete.own.posts",
        "admin.view.taxonomy",
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roleSuper = Role::create(['name' => 'superAdmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleAuthor = Role::create(['name' => 'author']);
        $roleStudent = Role::create(['name' => 'student']);
        $roleAlumni = Role::create(['name' => 'alumni']);

        foreach($this->permissions as $permission){
            $p = Permission::create(['name' => $permission]);
            $p->assignRole('superAdmin');
        }

        $roleAdmin->givePermissionTo(
            ["admin.view.posts",
            "admin.view.own.posts",
            "admin.view.other.posts",
            "admin.edit.other.posts",
            "admin.edit.own.posts",
            "admin.delete.posts",
            "admin.create.posts",
            "admin.duplicate.posts",
            "admin.delete.own.posts",
            "admin.delete.other.posts",
            "admin.publish.posts",
            "admin.archive.posts",
            "admin.view.post.revisions",
            "admin.edit.own.pages",
            "admin.view.pages",
            "admin.create.pages",
            "admin.edit.other.pages",
            "admin.duplicate.pages",
            "admin.delete.pages",
            "admin.publish.pages",
            "admin.archive.pages",
            "admin.view.page.revisions",
            "admin.create.media",
            "admin.view.media",
            "admin.edit.own.media",
            "admin.edit.other.media",
            "admin.delete.media",
            "admin.add.dashboard.cards",
            "admin.delete.dashboard.cards",
            "student.view.posts",
            "student.create.posts",
            "student.edit.own.posts",
            "student.edit.other.posts",
            "student.archive.posts",
            "student.view.pages",
            "student.create.comment",
            "student.edit.comment",
            "student.view.alumni.posts",
            "student.view.alumni.pages",
            "admin.view.settings",
            "admin.view.taxonomy"]
        );
        
        $roleEditor->givePermissionTo(
            ["admin.view.posts",
            "admin.view.own.posts",
            "admin.view.other.posts",
            "admin.edit.other.posts",
            "admin.edit.own.posts",
            "admin.create.posts",
            "admin.duplicate.posts",
            "admin.delete.own.posts",
            "admin.delete.other.posts",
            "admin.publish.posts",
            "admin.archive.posts",
            "admin.view.post.revisions",
            "admin.create.media",
            "admin.view.media",
            "admin.edit.own.media",
            "admin.edit.other.media",
            "admin.delete.media",
            "student.view.posts",
            "student.create.posts",
            "student.edit.own.posts",
            "student.edit.other.posts",
            "student.archive.posts",
            "student.view.pages",
            "student.create.comment",
            "student.edit.comment",
            "student.view.alumni.posts",
            "student.view.alumni.pages",
            "admin.view.taxonomy"]
        );

        $roleAuthor->givePermissionTo(
            ["admin.view.posts",
            "admin.view.own.posts",
            "admin.edit.own.posts",
            "admin.delete.own.posts",
            "admin.create.posts",
            "admin.duplicate.posts",
            "admin.view.post.revisions",
            "admin.create.media",
            "admin.view.media",
            "admin.edit.own.media",
            "student.view.posts",
            "student.create.posts",
            "student.edit.own.posts",
            "student.edit.other.posts",
            "student.view.pages",
            "student.create.comment",
            "student.edit.comment",
            "student.view.alumni.posts",
            "student.view.alumni.pages",
            "admin.view.taxonomy"]
        );

        $roleStudent->givePermissionTo(
            [
            "student.view.posts",
            "student.create.posts",
            "student.edit.own.posts",
            "student.delete.own.posts",
            "student.edit.other.posts",
            "student.view.pages",
            "student.create.comment",
            "student.edit.comment",]
        );
        
        $roleAlumni->givePermissionTo(
            [
            "student.view.posts",
            "student.create.posts",
            "student.delete.own.posts",
            "student.edit.own.posts",
            "student.edit.other.posts",
            "student.view.pages",
            "student.create.comment",
            "student.edit.comment",
            "student.view.alumni.posts",
            "student.view.alumni.pages"]
        );

    }
}
