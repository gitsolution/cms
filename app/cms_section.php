<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class cms_section extends Model
{
        protected $table='cms_sections';
        protected $fillable=['id_type','id_language','title','resumen','content','main_picture','private','publish_date','publish','uri','hits','order_by','active','register_by','modify_by'];
        protected $guarded=['id'];

        public function SetMain_pictureAttribute($main_picture){
        	$this->attributes['main_picture'] = Carbon::now()->Second.$path->getClienteOriginalName();
        	$name= Carbon::now()->Second.$path->getClienteOriginalName();
        	\Storage::diSK('local')->put($name,\File::get($main_picture));
        }
}
