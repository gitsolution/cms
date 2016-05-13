<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pp_reservation_details extends Model
{
   protected $table='pp_details_reservation';
   protected $fillable = array('id','id_price' ,'id_reservation');

}
