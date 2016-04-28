<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sys_module extends Model
{
    protected  $table='sys_modules';
    protected $fillable=['id_parent','title','description','active','register_by','modify_by'];
    protected $guarded=['id'];  
}
