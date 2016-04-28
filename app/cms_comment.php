<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cms_comment extends Model
{
        protected $table='cms_comments';
        protected $fillable=['id_comment','id_document','mail','title','content','active','publish'];
        protected $guarded=['id'];
}
