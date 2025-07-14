<?php

namespace App\Models;

use App\Models\Pembayaran;
use App\Models\KategoriIuran;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{


    protected $table = 'iurans';
    protected $fillable = [
        'kategori_iuran_id',
        'name',
        'jumlah',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
    public function kategoriIuran()
    {
        return $this->belongsTo(KategoriIuran::class, 'kategori_iuran_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
