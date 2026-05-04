<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
      protected $table = 'temas';

    protected $fillable = [
        'nome',
        'area_id'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function subtemas()
   {
    return $this->hasMany(Subtema::class);
   }

    public function niveis()
    {
        return $this->hasMany(Nivel::class);
    }
}
