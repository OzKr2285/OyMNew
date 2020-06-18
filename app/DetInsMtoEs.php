<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetInsMtoEs extends Model
{
    //
    protected $table = 'det_ins_mto_es';
    protected $fillable = ['id','id_det_mto','id_insumo','edo'];
    public $timestamps = false;
}
