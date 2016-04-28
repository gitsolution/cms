<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\usr_login_role;
use App\usr_role;
use App\User;
use App\usr_profile;
use Redirect;
use Session;
use DB;
use View;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class usr_login_roleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	 public function index()
	{	
		
	}
    
     public function store(Request $request)
     {        
        $n = count($request['role']); 
        $usrLoginRoles = DB::table('usr_login_roles')->where('id_login',$request['idUsuario'])->orderBy('id_login','Asc')->get();
        $b=0; $sRol=0;
        if($n>0){
            foreach ($usrLoginRoles as $rol) 
            { for ($i=0; $i <$n ; $i++) 
                {   $j=$request['role'][$i];    
                    if($rol->id_role==$j){$b=1;break;}else{$b=0;}                       
                }

                $id=DB::table('usr_login_roles')->whereid_login($request['idUsuario'])->whereid_role($rol->id_role)->first();
                if($id!=null){$idR=$id->id;}else{$idR=0;}
                 if($b==1){
                    DB::update('update usr_login_roles set active = ?, modify_by = ? where id = ?', array(1, Auth::User()->id, $idR));
                    }                    
                else{                       
                    DB::update('update usr_login_roles set active = ?, modify_by = ? where id = ?', array(0, Auth::User()->id, $idR));
                    }  
            }
        }
        else
        {
            foreach ($usrLoginRoles as $rol) 
            {
                $id=DB::table('usr_login_roles')->whereid_login($request['idUsuario'])->whereid_role($rol->id_role)->first();
                if($id!=null){$idR=$id->id;}else{$idR=0;}
                DB::update('update usr_login_roles set active = ?, modify_by = ? where id = ?', array(0, Auth::User()->id, $idR));
            }
        }

            for ($i=0; $i <$n ; $i++) 
            {
                $j=$request['role'][$i];
                $r=DB::table('usr_login_roles')->where('id_login',$request['idUsuario'])->where('id_role',$j)->first();   
                if ($r==null){                
                     usr_login_role::create([
                            'id_login'=>$request['idUsuario'],
                            'id_role'=>$j,
                            'active'=>'1',
                            'register_by'=>Auth::User()->id,
                            'modify_by'=>Auth::User()->id,
                        ]);
                }
                
            }
        
        Session::flash('message','Roles Guardados Correctamente');    
            return redirect('usuario'); 
    }

    public function create()
    {
        return view('usuario.create');
    }

    public function edit($id)
    {
        $roles=usr_role::find($id);
        return view('roles.rolesform')->with('roles',$roles);
    }

    public function update($id,Request $request)
    {
        $dato = $request['vRoles'];
        $num=count($dato);
        $roles=DB::table('usr_roles')->select('id')->get();
        $c=0;
        $b=0;
        
        foreach ($roles as $rol) 
        {
            for($i=0;$i<$num;$i++)
            {
                if($rol->id==$dato[$i])
                {  
                    $rolActive[$c]=$rol->id;
                    //echo "Active: ".$rolActive[$c]."<br>";
                    $usrRole= new usr_login_role;
                    $usrRole->where('id_login', '=', $id)->where('id_role','=',$rolActive[$c])
                    ->update(['active' => 1]); 
                    $b=1;
                    
                }
            }

            if($b==0)
            {
                $rolNoActive[$c]=$rol->id;
                $usrRole= new usr_login_role;
                $usrRole->where('id_login', '=', $id)->where('id_role','=',$rolNoActive[$c])
                ->update(['active' => 0]); 
                
            }
            $b=0;
            $c++;
        }

        return view('layouts.app');

    }

     public function delete($id)
    {
        $query=usr_role::destroy($id);
        Session::flash('message','Role Eliminado Correctamente');  
        return Redirect::to("admin/roles"); 
        return view('layouts.app');
    }


    public function updateRol($id)
    {
        $nombre=DB::table('usr_profiles')->where('id',$id)->select('name', 'lastName')->first();
        $nombreCompleto=$nombre->name." ".$nombre->lastName;
        $roles=DB::table('usr_roles')->where('active',1)->select('id', 'title')->get();
        $chek=DB::table('usr_login_roles')->where('id_login',$id)->where('active',1)->select('id_role')->get();

        return View::make('roles/asignacionRoles',compact('id','nombreCompleto','roles','chek'));
    }
}

/*$user = User::find($request['idUsuario']);
        $r = usr_login_role::find($request['idUsuario']);
        $r->attach(1);*/
        //$user->()->attach($request['roles']);
        //$user->roles()->sync(Input::get('role'));