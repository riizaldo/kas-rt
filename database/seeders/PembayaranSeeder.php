<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Iuran;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $iuran = Iuran::first();

        $users = User::role('warga')->take(3)->get();

        foreach ($users as $user) {
            Pembayaran::create([
                'user_id' => $user->id,
                'iuran_id' => $iuran->id,
                'jumlah_bayar' => 10000,
                'tanggal_bayar' => now(),
                'keterangan' => 'Pembayaran lunas',
            ]);
        }
    }
}
