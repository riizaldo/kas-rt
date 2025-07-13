<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    protected $table = 'rukun_tetangga';
    protected $fillable = [
        'name',
        'keterangan'
    ];
}
