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
        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'bendahara']);
        Role::create(['name' => 'warga']);

        // Tambah ke user admin
        $admin = \App\Models\User::where('email', 'admin@desa.local')->first();
        if ($admin) {
            $admin->assignRole('admin');
        }
    }
}
