<?php

namespace App\Models;

use App\Models\RT;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rt()
    {
        return $this->belongsTo(RT::class);
    }
}
