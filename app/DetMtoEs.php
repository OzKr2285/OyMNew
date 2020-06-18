<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetMtoEs extends Model
{
    //
    protected $table = 'det_mto_es';
    protected $fillable = ['id','id_mto','id_equipo','desc','tp_tren','id_etapa'];
    public $timestamps = false;
    
    public function MtoEs(){
        return $this->belongsTo('App\MtoEs');
    }  
}
