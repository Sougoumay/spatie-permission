<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //create permissions
        Permission::create(['name'=>'edit articles']);
        Permission::create(['name'=>'delete articles']);
        Permission::create(['name'=>'publish articles']);
        Permission::create(['name'=>'unPublish articles']);
        Permission::create(['name'=>'read articles']);

        $role1 = Role::create(['name'=>'writer']);
        $role1->syncPermissions(['edit articles','delete articles','read articles']);

        $role2 = Role::create(['name'=>'admin']);
        $role2->givePermissionTo('publish articles');
        $role2->givePermissionTo('unPublish articles');
        $role2->givePermissionTo('read articles');

        $role3 = Role::create(['name'=>'Super-Admin']);

        $role4 = Role::create(['name'=>'user']);
        $role4->givePermissionTo('read articles');

        // Create demo User
        $user1 = \App\Models\User::create([
            'name'=>'Example User',
            'email'=>'test@example.com',
            'password'=>Hash::make('password')
        ]);

        $user1->assignRole($role1);

        $user2 = User::create([
            'name'=>'Example Admin User',
            'email'=>'admin@example.com',
            'password'=>Hash::make('password')
        ]);

        $user2->assignRole($role2);

        $user3 = User::create([
            'name'=>'Example Admin User',
            'email'=>'admin-user@example.com',
            'password'=>Hash::make('password')
        ]);

        $user3->assignRole($role3);

        $user4 = User::create([
            'name'=>'User Example',
            'email'=>'user@example.com',
            'password'=>Hash::make('password')
        ]);

        $user4->assignRole($role4);
    }
}
