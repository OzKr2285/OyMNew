<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaRed extends Model
{
    //
    protected $table = 'fichared';
    protected $fillable = [
        'codigo', 
        'tp_red', 
        'clasi', 
        'cant_p', 
        'nombre',
        'id_mpio',
        'desc',
        'total',
        'plano_g',
        'plano_a',
        'plano_c',
        'plano_p'        
    ];
    public $timestamps = false;
}
