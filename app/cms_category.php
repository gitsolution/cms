<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cms_category extends Model
{
  protected $table='cms_categories';
   protected $fillable=['id_section','title','resumen','content','main_picture','private','publish_date','publish','uri','hits','order_by','active','register_by','modify_by'];
        protected $guarded=['id'];
 

        public static function category($id){
        	return cms_category::where('id_section','=',$id)
        	->get();
        }
 
}



