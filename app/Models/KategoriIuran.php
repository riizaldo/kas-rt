<?php

namespace App\Models;

use App\Models\Iuran;
use Illuminate\Database\Eloquent\Model;

class KategoriIuran extends Model
{

    protected $table = 'kategori_iurans';

    protected $fillable = [
        'nama',
        'deskripsi',
        'jumlah_default',
        'frekuensi'
    ];

    public function iurans()
    {
        return $this->hasMany(Iuran::class);
    }
}
