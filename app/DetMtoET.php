<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetMtoET extends Model
{
    //
    protected $table = 'det_mto_et';
    protected $fillable = ['id','id_mto','id_equipo','edo','obs'];
    public $timestamps = false;
}
