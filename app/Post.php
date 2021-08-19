<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getDisplayCategoriaAttribute()
    {
        dd($this->categoria);
        return ($this->categoria == 'noticias') ? 'UkeNoticias' : 'Datos Curioso';
    }
}
