<?php

namespace Database\Seeders;

use App\Models\Iuran;
use App\Models\KategoriIuran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = KategoriIuran::first();

        Iuran::create([
            'kategori_iuran_id' => $kategori->id,
            'name' => 'Iuran Keamanan Juli 2025',
            'jumlah' => 10000,
            'tanggal_mulai' => now()->startOfMonth(),
            'tanggal_selesai' => now()->endOfMonth(),
        ]);
    }
}
