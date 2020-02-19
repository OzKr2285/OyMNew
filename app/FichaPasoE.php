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
        'nombre',
        'desc',
        'total',
        'plano'       
    ];
    public $timestamps = false;
}
