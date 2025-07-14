<?php

namespace Database\Seeders;

use App\Models\RT;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RT::insert([
            ['name' => 'RT 01', 'keterangan' => 'Blok A'],
            ['name' => 'RT 02', 'keterangan' => 'Blok B'],
        ]);
    }
}
