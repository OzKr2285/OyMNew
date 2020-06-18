<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetEqHtaMtoEs extends Model
{
    //
    protected $table = 'det_eqhta_mto_es';
    protected $fillable = ['id','id_det_mto','id_eq_hta','edo'];
    public $timestamps = false;
}
