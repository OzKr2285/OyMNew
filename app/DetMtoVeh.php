<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetMtoVeh extends Model
{
    //
    protected $table = 'det_mto_veh';
    protected $fillable = ['id','id_mto','id_act','edo'];
    public $timestamps = false;
}
