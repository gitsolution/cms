<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
     protected $table='men_menus';

     protected $fillable = array('id_men_type','id_language','title', 'description','uri','order_by','active', 'register_by','modify_by');

   
}
