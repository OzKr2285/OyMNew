<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetActMtoEs extends Model
{
    //
    protected $table = 'det_act_mto_es';
    protected $fillable = ['id','id_det_mto','id_actividad','edo'];
    public $timestamps = false;
}
