<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetInsEquipo extends Model
{
    //
    protected $table = 'det_ins_equipo';
    protected $fillable = ['id','id_insumo','observacion'];
    public $timestamps = false;

 
    public function Insumo()
    {
        return $this->belongsTo('App\Insumo');
    }
}
