<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaPasoE extends Model
{
    //
    protected $table = 'ficha_pasoe';
    protected $fillable = [
        'id', 
        'id_red', 
        'codigo',
        'nombre',
        'desc',
        'nivel',
        'id_tp_estru',
        'id_tp_tub',
        'fec_opera',
        'total',
        'plano'       
    ];
    public $timestamps = false;
}
