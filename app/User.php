<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
//class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $table='users';

   protected $fillable=['email','password','active','remember_token ','register_by','modify_by'];

    protected $guarded=['id'];

    public function setPasswordAttribute($valor)
    {
    	if(!empty($valor))
    	{
    		$this->attributes['password']=\Hash::make($valor);
    	}
    }

    public function roles(){
        return $this->belongsToMany('\App\usr_role','usr_login_roles')
            ->withPivot('active');
    }

}
