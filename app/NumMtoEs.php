<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumMtoEs extends Model
{
    //
    protected $table = 'num_mto_es';
    protected $fillable = ['id','id_estacion','num','abrev'];
    public $timestamps = false;

}
