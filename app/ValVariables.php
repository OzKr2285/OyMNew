<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValVariables extends Model
{
    //
    protected $table = 'val_variables';
    protected $fillable = ['id','nombre'];
    public $timestamps = false;
}
