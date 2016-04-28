<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
	    //
    protected $table = 'med_pictures';     
    protected $fillable = array('id_album','title', 'description','uri','publish', 'publish_date', 'path','mime_type','extension','hits','order_by','active','register_by','modify_by');
   
    protected $casts = [
        'publish_date' => 'd-m-Y',
    ];

  


}
