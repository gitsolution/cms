<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pp_subscribe extends Model
{
   protected $table='pp_subscribe';
   protected $fillable = array('id','name','surnames', 'email','active',);
}
