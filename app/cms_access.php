<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cms_access extends Model
{
  	protected  $table='cms_accesses';

    //protected $fillable=['id_sysmodule','title','description','active','register_by','modify_by'];
	protected $fillable=['id_sysmodule','title','active','register_by','modify_by'];
    protected $guarded=['id'];  
}
