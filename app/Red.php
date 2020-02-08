<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Red extends Model
{
    //
    protected $table = 'tp_material_red';
    protected $fillable = ['id','nombre'];
    public $timestamps = false;
}
