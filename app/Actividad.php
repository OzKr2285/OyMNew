<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //
    protected $table = 'actividades';
    protected $fillable = ['id','nombre','duracion','equivale','desc','is_equipo'];
    public $timestamps = false;

    public function detActEquipo()
    {
        return $this->hasOne('App\DetActEquipo');
    }
}
