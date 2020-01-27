<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TecMtoEC extends Model
{
    //
    protected $table = 'tec_mto_ec';
    protected $fillable = ['id','id_mtoec','id_tecnico','is_respo'];
    public $timestamps = false;

}
