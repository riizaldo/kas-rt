<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\RTSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\IuranSeeder;
use Database\Seeders\WargaSeeder;
use Database\Seeders\PembayaranSeeder;
use Database\Seeders\KategoriIuranSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RTSeeder::class,
            UserSeeder::class,
            WargaSeeder::class,
            // Warga2seeder::class,
            KategoriIuranSeeder::class,
            IuranSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}
