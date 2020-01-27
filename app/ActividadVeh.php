<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadVeh extends Model
{
    //
    protected $table = 'act_veh';
    protected $fillable = ['id','nombre','desc'];
    public $timestamps = false;
}
