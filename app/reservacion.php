<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservacion extends Model
{
     protected $table='reservacion';
     protected $fillable = array('id', 'llegada','salida','habitacion','adultos', 'menores','promo');
}
