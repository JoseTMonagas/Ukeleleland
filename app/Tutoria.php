<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutoria extends Model
{
    protected $fillable = ['tipo', 'cantidad', 'fecha_inicio', 'fecha_termino', 'observaciones'];

    public function users ()
    {
        return $this->belongsToMany('\App\User')->withTimestamps()->withPivot("tipo");
    }

    public function clases ()
    {
        return $this->hasMany('\App\Clase');
    }

    public function getTutorAttribute()
    {
        return $this->users()->where('tipo', 'tutor')->first();
    }

    public function getEstudianteAttribute()
    {
        return $this->users()->where('tipo', 'estudiante')->first();
    }
}
