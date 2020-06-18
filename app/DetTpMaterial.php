<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetTpMaterial extends Model
{
    //
    protected $table = 'det_tp_material';
    protected $fillable = ['id','id_tp_material','codigo','nombre'];
    public $timestamps = false;
}
