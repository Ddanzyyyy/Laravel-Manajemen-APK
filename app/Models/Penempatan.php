<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    protected $fillable = [
        'user_id',
        'keterangan',
        'foto_tugas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
