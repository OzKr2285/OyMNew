<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CierrePqrsServ extends Model
{
    //
    protected $table = 'cierre_serv_pqrs';
    protected $fillable = ['id','id_serv_pqrs','id_auxiliar','fecha','tp_rta','tp_notifica','desc'];
    public $timestamps = false;
}
