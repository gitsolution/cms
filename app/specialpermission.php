<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class specialpermission extends Model
{
    protected  $table='special_permissions';

    protected $fillable=['id_user','id_usermolrol','access','active','register_by','modify_by'];

    protected $guarded=['id'];  
}
