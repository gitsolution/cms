<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemMenu extends Model
{
     protected $table='men_items';
     protected $fillable = array('id_menu','id_parent','title', 'description','size','target','uri','img','ext','level','order_by','private','publish','active','register_by','modify_by');
   
     
}

 