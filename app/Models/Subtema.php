<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subtema extends Model
{
     protected $fillable = [
        'nome',
        'tema_id'
    ];

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }
}
