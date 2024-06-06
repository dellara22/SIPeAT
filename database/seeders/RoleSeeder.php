<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin'])->givePermissionTo(['create', 'read', 'edit', 'delete']);
        Role::create(['name' => 'user'])->givePermissionTo(['create', 'read']);
    }
}
