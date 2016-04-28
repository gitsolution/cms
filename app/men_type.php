<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class men_type extends Model
{
     protected $table='men_types';
       protected $fillable = array('title', 'description','uri','order_by','publish', 'active', 'register_by','modify_by')
      protected $guarded=['id_role','id_access'];
}
