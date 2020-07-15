<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TecMtoRed extends Model
{
    //
    protected $table = 'tec_mto_red';
    protected $fillable = ['id','id_mto','id_tecnico','is_respo'];
    public $timestamps = false;
}
