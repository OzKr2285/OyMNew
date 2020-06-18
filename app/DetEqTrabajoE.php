<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetEqTrabajoE extends Model
{
    //
    protected $table = 'det_eqtrabajoe';
    protected $fillable = ['id','id_eq_trabajoe','observacion','id_refequipo','id_eq_equipo'];
    public $timestamps = false;
}
