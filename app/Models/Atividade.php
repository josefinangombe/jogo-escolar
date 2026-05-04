<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $table = 'atividades';

    protected $fillable = [
        'tipo',
        'nivel_id'
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }
}
