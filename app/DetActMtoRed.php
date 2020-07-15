<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetActMtoRed extends Model
{
    //
    protected $table = 'det_act_mto_red';
    protected $fillable = ['id','id_mto','id_actividad','edo'];
    public $timestamps = false;
}
