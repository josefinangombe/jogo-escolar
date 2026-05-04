<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
     protected $table = 'areas';

    protected $fillable = [
        'nome'
    ];

    public function temas()
    {
        return $this->hasMany(Tema::class);
    }
}
