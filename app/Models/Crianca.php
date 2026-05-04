<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crianca extends Model
{
     protected $table = 'criancas';

    protected $fillable = [
        'nome',
        'idade',
        'encarregado_id'
    ];

    public function progressos()
    {
        return $this->hasMany(Progresso::class);
    }
}
