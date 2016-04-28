<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeMenu extends Model
{

     protected $table='men_types';
       protected $fillable = array('title', 'description','uri','order_by','publish', 'active', 'register_by','modify_by');
   
}
