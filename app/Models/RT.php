<?php

namespace App\Models;

use App\Models\User;
use App\Models\Warga;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    protected $table = 'rukun_tetangga';
    protected $fillable = [
        'name',
        'keterangan'
    ];

    public function wargas()
    {
        return $this->hasMany(Warga::class, 'rt_id', 'id');
    }

    public function pembayarans()
    {
        return $this->hasManyThrough(
            Pembayaran::class, // model tujuan akhir
            User::class,       // model perantara
            'id',                          // FK di model perantara (User) → User.id
            'user_id',                     // FK di model akhir (Pembayaran) → Pembayaran.user_id
            'id',                          // FK lokal di RT → RT.id
            'id'                           // FK di warga → User.id dicocokkan ke warga.user_id
        )->whereHas('wargas', function ($query) {
            $query->whereColumn('wargas.rt_id', 'rukun_tetangga.id');
        });
    }
}
