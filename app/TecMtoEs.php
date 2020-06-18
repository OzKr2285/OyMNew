<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TecMtoEs extends Model
{
    //
    protected $table = 'tec_mto_es';
    protected $fillable = ['id','id_mto_es','id_tecnico','is_respo'];
    public $timestamps = false;
}
