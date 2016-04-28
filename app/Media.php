<?php

namespace App;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $table = 'med_albums';
     
    protected $fillable = array('title', 'description','order_by','uri','publish', 'publish_date', 'path', 'index_page','hits','active', 'register_by','modify_by');
   // protected $hidden = array('hits','active', 'register_by', 'register_date','modify_by', 'modify_date' );

    protected $casts = [
        'publish_date' => 'd-m-Y',
    ];

 

	public function setDelete($valor){
        if(!empty($valor)){
            $this->attributes['active'] = \Hash::make($valor);
        }
    }

  
  }