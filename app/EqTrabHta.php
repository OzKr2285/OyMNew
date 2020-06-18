<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EqTrabHta extends Model
{
    //
    protected $table = 'eq_trab_hta';
    protected $fillable = ['id','nombre','is_equipo'];
    public $timestamps = false;
}
