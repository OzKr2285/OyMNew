<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsumoE extends Model
{
    //
    protected $table = 'insumose';
    protected $fillable = ['id','desc','id_refequipo'];
    public $timestamps = false;
}
