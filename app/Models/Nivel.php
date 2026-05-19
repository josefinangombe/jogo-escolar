<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveis';

    protected $fillable = [
        'nome',
        'ordem',
        'subtema_id',
        'desbloqueado'
    ];

    protected $casts = [
        'desbloqueado' => 'boolean'
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