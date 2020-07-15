<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetReqInsumo extends Model
{
    //
    protected $table = 'det_req_insumos';
    protected $fillable = ['id','id_insumo','cant','id_req_insumo','edo','fec_entrega'];
    public $timestamps = false;
}
