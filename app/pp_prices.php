<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pp_prices extends Model
{
   protected $table='pp_prices';
   protected $fillable = array('id', 'title','price','date_start','date_end','active', 'active_price', 'active');
}

