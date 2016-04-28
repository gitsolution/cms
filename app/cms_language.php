<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cms_language extends Model
{
     protected $table='cms_language';
     protected $fillable = array('id', 'label','description','code','short_code', 'status', 'active');
}
