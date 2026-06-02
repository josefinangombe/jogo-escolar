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
        'nivel_id',     // ✨ ADICIONADO AQUI
        'atividade_id'  // Podes manter se também usares
    ];

    public function crianca()
    {
        return $this->belongsTo(Crianca::class);
    }

    // Se adicionares o nivel_id, podes criar a relação também:
    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }
}