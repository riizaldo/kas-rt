<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluarans';
    protected $fillable = [
        'nama',
        'keterangan',
        'jumlah',
        'tanggal',
    ];
}
