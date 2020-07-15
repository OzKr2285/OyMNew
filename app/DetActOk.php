<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetActOk extends Model
{
    //
    protected $table = 'det_act_ok';
    protected $fillable = ['id','id_actividad','nombre','order'];
    public $timestamps = false;
}
