<?php

namespace App;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    //
    protected $table = 'sys_directories';
     
    protected $fillable = array('title', 'description','order_by','uri','publish', 'publish_date', 'path', 'index_page','hits','active', 'register_by','modify_by');
 
    protected $casts = [
        'publish_date' => 'd-m-Y',
    ];

  }