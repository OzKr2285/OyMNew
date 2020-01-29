<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketServ extends Model
{
    //
    protected $table = 'serv_pqrs';
    protected $fillable = ['id','id_usuario','id_objpqrs','id_lider','tp_causal','id_causal','medio','prioridad','desc','fecha','edo','is_respo'];
    public $timestamps = false;
}
