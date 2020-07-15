<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetEqhtaMtoRed extends Model
{
    //
    protected $table = 'det_eqhta_mto_red';
    protected $fillable = ['id','id_mto','id_eq_hta','edo'];
    public $timestamps = false;
}
