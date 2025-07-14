<?php

namespace App\Models;

use App\Models\User;
use App\Models\Iuran;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{


    protected $table = 'pembayarans';
    protected $fillable = [
        'user_id',
        'iuran_id',
        'jumlah_bayar',
        'tanggal_bayar',
        'keterangan'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function iuran()
    {
        return $this->belongsTo(Iuran::class);
    }
}
