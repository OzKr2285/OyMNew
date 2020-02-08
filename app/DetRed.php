<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetRed extends Model
{
    //
    protected $table = 'det_red';
    protected $fillable = ['id','id_red','id_diametro','id_material','fec_opera','obs','longitud','edo'];
    public $timestamps = false;

}
