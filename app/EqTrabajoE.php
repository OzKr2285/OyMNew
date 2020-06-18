<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EqTrabajoE extends Model
{
    //
    protected $table = 'eq_trabajoe';
    protected $fillable = ['id','desc'];
    public $timestamps = false;
}
