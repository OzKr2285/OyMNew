<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MtoET extends Model
{
    //
    protected $table = 'mto_et';
    protected $fillable = ['id','fec_realiza','fec_finaliza','tp_mto','obs','id_refequipo','edo'];
    public $timestamps = false;
}
