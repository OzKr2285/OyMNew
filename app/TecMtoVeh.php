<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TecMtoVeh extends Model
{
    //
    protected $table = 'tec_mto_veh';
    protected $fillable = ['id','id_mto_veh','id_tecnico','is_respo'];
    public $timestamps = false;
}
