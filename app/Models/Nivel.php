<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveis';

    protected $fillable = [
        'dificuldade',
        'idade_min',
        'idade_max',
        'tema_id'
    ];

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }

    public function atividades()
    {
        return $this->hasMany(Atividade::class);
    }
}
