<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Reset cached roles and permissions
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'create',
            'read',
            'update',
            'delete',
        ];
        $roles = [
            'admin',
            'user',
        ];
        $entities = [
            'users',
            'roles',
            'store',
            'sales',
            'reports',
            'return',
           
        ];

        foreach ($permissions as $permission) {
            foreach ($entities as $entity) {
                 Permission::create(['name' => $permission.'-'.$entity ]);
            }
           
        }

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $role = Role::findByName('admin');
        $role->givePermissionTo(Permission::all());
        $userRole = User::find(1)->assignRole('admin');

}


        }
