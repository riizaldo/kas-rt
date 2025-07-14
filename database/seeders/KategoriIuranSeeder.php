<?php

namespace Database\Seeders;

use App\Models\KategoriIuran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriIuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriIuran::insert([
            [
                'nama' => 'Iuran Keamanan',
                'deskripsi' => 'Iuran bulanan untuk keamanan lingkungan',
                'jumlah_default' => 10000,
                'frekuensi' => 'bulanan',
            ],
            [
                'nama' => 'Iuran Sampah',
                'deskripsi' => 'Iuran sampah rutin',
                'jumlah_default' => 15000,
                'frekuensi' => 'bulanan',
            ],
        ]);
    }
}
