<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpPasoE extends Model
{
    //
    protected $table = 'tp_pasoe';
    protected $fillable = ['id','nombre'];
    public $timestamps = false;
}
