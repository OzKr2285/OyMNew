<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetInsMtoRed extends Model
{
    //
    protected $table = 'det_ins_mto_red';
    protected $fillable = ['id','id_mto','id_insumo','edo'];
    public $timestamps = false;
}
