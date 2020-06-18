<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetActMtoET extends Model
{
    //
    protected $table = 'det_act_mto_et';
    protected $fillable = ['id','id_mto_et','id_actividad','id_equipo','edo'];
    public $timestamps = false;
}
