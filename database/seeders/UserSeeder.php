<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::findOrCreate('admin');
        Role::findOrCreate('bendahara');
        Role::findOrCreate('warga');

        $admin = User::create([
            'name' => 'Admin RT',
            'email' => 'admin@desa.local',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $bendahara = User::create([
            'name' => 'Bendahara',
            'email' => 'bendahara@desa.local',
            'password' => bcrypt('password'),
        ]);
        $bendahara->assignRole('bendahara');

        for ($i = 1; $i <= 5; $i++) {
            $w = User::create([
                'name' => "Warga $i",
                'email' => "warga$i@desa.local",
                'password' => bcrypt('password'),
            ]);
            $w->assignRole('warga');
        }
    }
}
