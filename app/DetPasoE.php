<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetPasoE extends Model
{
    //
    protected $table = 'det_pasoe';
    protected $fillable = ['id','id_paso','tp_pasoe','id_diametro','id_material','fec_opera','obs','longitud','edo','coor_x','coor_y'];
    public $timestamps = false;

}
