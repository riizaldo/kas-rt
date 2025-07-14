<?php

namespace Database\Seeders;

use App\Models\RT;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rts = RT::pluck('id')->toArray();

        $users = User::role('warga')->get();

        foreach ($users as $i => $user) {
            Warga::create([
                'user_id' => $user->id,
                'rt_id' => $rts[array_rand($rts)],
                'nik' => '32760' . rand(10000000, 99999999),
                'no_kk' => '32760' . rand(10000000, 99999999),
                'nama_lengkap' => $user->name,
                'blok' => ['A', 'B', 'C'][rand(0, 2)],
                'no_rumah' => str_pad(rand(1, 100), 2, '0', STR_PAD_LEFT),
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'jenis_kelamin' => rand(0, 1) ? 'L' : 'P',
                'tanggal_lahir' => now()->subYears(rand(20, 60)),
                'alamat' => 'Alamat fiktif',
                'pekerjaan' => 'Karyawan',
                'status_perkawinan' => rand(0, 1) ? 'kawin' : 'belum',
                'is_aktif' => true,
            ]);
        }
    }
}
