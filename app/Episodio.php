<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    public function temporada()
    {
        $this->belongsTo(Temporada::class);
    }
}
