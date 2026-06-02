<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $table = 'atividades';

    protected $fillable = [
        'enunciado',
        'tipo_interacao',
        'modo_escrita',
        'dados',
        'resposta_correta',
        'imagem',
        'audio',
        'nivel_id'
    ];

    // ✅ CORRETO: cast completo
    protected $casts = [
        'dados' => 'array',
        'resposta_correta' => 'array',
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }
}