<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemFile extends Model
{
    //
	    //
    protected $table = 'sys_files';     
    protected $fillable = array('id_directory','title', 'description','uri','publish', 'publish_date', 'path','mime_type','extension','hits','order_by','active','register_by','modify_by');
   
    protected $casts = ['publish_date' => 'd-m-Y',];

}
