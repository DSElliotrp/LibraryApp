<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $librarianRole = Role::create(['name' => 'librarian']);
        $customerRole = Role::create(['name' => 'customer']);

        $createBookPermission = Permission::create(['name' => 'create books']);
        $editBookPermission = Permission::create(['name' => 'edit books']);
        $loanBookPermission = Permission::create(['name' => 'loan books']);
        $viewMyBooksPermission = Permission::create(['name' => 'view my books']);

        $librarianRole->givePermissionTo($createBookPermission, $editBookPermission, $loanBookPermission);
        $customerRole->givePermissionTo($viewMyBooksPermission);
    }
}
