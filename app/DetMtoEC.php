<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetMtoEC extends Model
{
    //
    protected $table = 'det_mto_ec';
    protected $fillable = ['id','id_mto','id_equipo','edo'];
    public $timestamps = false;
}
