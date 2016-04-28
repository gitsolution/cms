<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usr_role extends Model 
{
    protected  $table='usr_roles';

    protected $fillable=['id','title','description','active','created_at'];
    
    protected $guarded=['id'];

    public function users()
    {
    	return $this->belongsToMany('\App\User','usr_login_roles');
     		 
 	}

}
