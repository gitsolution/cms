<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usr_module_rol extends Model
{
     protected  $table='user_module_rol';

    protected $fillable=['id','id_role','id_sysmodules','active','access_granted','resgister_by','modify_by'];

    protected $guarded=['id'];
}
