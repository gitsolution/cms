<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pp_reservation extends Model
{
   protected $table='pp_reservation';
   protected $fillable = array('id','name','surnames','nights' ,'arrival','departure','room','grownups', 'minors','promotions','amount','sincronizado');
}
