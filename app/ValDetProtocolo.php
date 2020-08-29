<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValDetProtocolo extends Model
{
    //
    protected $table = 'val_det_protocolo';
    protected $fillable = ['id','id_etapa','id_variable','id_protocolo','brazo_ppal','brazo_bypass','is_valida','valor','signo','valor2','obs'];
    public $timestamps = false;
}
