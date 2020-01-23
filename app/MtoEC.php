<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MtoEC extends Model
{
    //
    protected $table = 'mto_ec';
    protected $fillable = ['id','fec_realiza','fec_finaliza','tp_mto','obs','id_oficina','edo'];
    public $timestamps = false;
}
