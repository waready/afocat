<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Afiliaciones']);
        $role3 = Role::create(['name' => 'Catastros']);
       // $role4 = Role::create(['name' => 'Director']);
        
        Permission::create(['name' => 'admin.home'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.admin.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.admin.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.admin.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.admin.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.afiliaciones.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.afiliaciones.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.afiliaciones.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.afiliaciones.destroy'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'admin.catastros.index'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'admin.catastros.create'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'admin.catastros.edit'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'admin.catastros.destroy'])->syncRoles([$role1,$role2,$role3]);
    }
}
