<?php

namespace App\Models;

use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Model;

class KategoriPengeluaran extends Model
{
    protected $table = 'kategori_pengeluarans';
    protected $fillable = [
        'nama',
    ];

    public function pengeluarans()
    {
        return $this->hasMany(Pengeluaran::class, 'kategori_pengeluaran_id');
    }
}
