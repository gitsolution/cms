<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usr_profile extends Model
{
    protected  $table='usr_profiles';

    protected $fillable=['id','name','lastname','picture','gender','born_date'];

    protected $guarded=['id'];

    
}
