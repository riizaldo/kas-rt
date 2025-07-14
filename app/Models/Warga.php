<?php

namespace App\Models;

use App\Models\RT;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{

    protected $table = 'wargas';
    protected $fillable = [
        'user_id',
        'rt_id',
        'nik',
        'no_kk',
        'nama_lengkap',
        'blok',
        'no_rumah',
        'no_hp',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'pekerjaan',
        'status_perkawinan',
        'is_aktif',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rt()
    {
        return $this->belongsTo(RT::class, 'rt_id', 'id');
    }
}

//ts
