<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValProtocolos extends Model
{
    //
    protected $table = 'val_protocolos';
    protected $fillable = ['id','id_estacion','desc'];
    public $timestamps = false;
}
