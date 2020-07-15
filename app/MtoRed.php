<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MtoRed extends Model
{
    //
    protected $table = 'mto_red';
    protected $fillable = ['id','fec_realiza','fec_finaliza','tp_mto','frec','obs','id_red','edo'];
    public $timestamps = false;
}
