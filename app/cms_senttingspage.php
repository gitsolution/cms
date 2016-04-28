<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cms_senttingspage extends Model
{
    protected $table='cms_senttingspages';
    protected $fillable=['clave','value','active','register_by','modify_by'];
    protected $guarded=['id'];
}
