<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = [
        'id', 'nombre','contacto', 'telefono','direccion','email','id_mpio'
    ];
    public $timestamps = false;





}
