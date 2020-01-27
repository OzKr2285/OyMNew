<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MtoVeh extends Model
{
    //
    protected $table = 'mto_veh';
    protected $fillable = ['id','fec_realiza','fec_finaliza','tp_mto','obs','placa','edo'];
    public $timestamps = false;
}
