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
        'subtema_id'
    ];

    public function subtema()
    {
        return $this->belongsTo(Subtema::class);
    }

    public function atividades()
    {
        return $this->hasMany(Atividade::class);
    }
}
