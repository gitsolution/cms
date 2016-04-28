<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cms_document extends Model
{
     protected $table='cms_documents';
        protected $fillable=['id_category','title','resumen','content','main_picture','private','publish_date','publish','uri','hits','order_by','active','register_by','modify_by'];
        
        protected $guarded=['id'];
}
