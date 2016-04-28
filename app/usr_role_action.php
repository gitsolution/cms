<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usr_role_action extends Model
{
    protected  $table='usr_role_actions';

    protected $fillable=['id_role','id_access','action','allowed','access','active','register_by','modify_by'];

    protected $guarded=['id_role','id_access'];
}
