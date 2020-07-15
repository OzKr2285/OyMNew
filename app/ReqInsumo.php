<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReqInsumo extends Model
{
    //
    protected $table = 'req_insumos';
    protected $fillable = ['id','id_tecnico','obs','fec_solicitud','edo','cod_estacion','id_mto'];
    public $timestamps = false;
}
