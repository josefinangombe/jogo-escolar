<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progresso extends Model
{
    protected $table = 'progressos';

    protected $fillable = [
        'estado',
        'pontuacao',
        'crianca_id',
        'atividade_id'
    ];

    public function crianca()
    {
        return $this->belongsTo(Crianca::class);
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }
}
