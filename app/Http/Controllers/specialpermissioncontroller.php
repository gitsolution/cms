<?php

namespace App\Http\Controllers;

use View;
use DB;
use Illuminate\Http\Request;
use App\cms_access;
use App\usr_role;
use App\sys_module;
use App\usr_module_rol;
use App\specialpermission;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route;
use Session;
use Gate;
use Redirect;
class specialpermissioncontroller extends Controller
{
	public function store(Request $request)
	{  
    /*
        if(Gate::denies('Usuarios.ModulodeUsuarios'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('Usuarios.SubmodulodeUsuarios'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('Usuarios.Asignarpermisosespeciales'))
        {
          Auth::logout();
          return Redirect('login');
        }*/

         //$request['idusuarioactual'];
          //rol  $request['id'];




       if($request['idRole']!=null)
        { 
            $idusuariomodulorol=0;
            $idModulo=$request['idModule'];
            $json=$request['jsn'];
            $idusuarioactual=$request['idusuarioactual'];
     
            $idusermolrol=DB::table('user_module_rol')->whereid_role($request['idRole'])->whereid_sysmodules($idModulo)->first();
           
            if($idusermolrol!=null)
            {$idusuariomodulorol=$idusermolrol->id;}

            $v=DB::table('special_permissions')->whereid_user($idusuarioactual)->whereid_usermolrol($idusuariomodulorol)->first();

            if($v!=null)
            {
                $query=DB::table('special_permissions')->whereid_user($idusuarioactual)->whereid_usermolrol($idusuariomodulorol)->update(array('access' => $json));

                Session::flash('message','Permisos agregado correctamente'); 

                $flag="1";
               
                $users = DB::table('usr_profiles')
                    ->leftJoin('users', 'usr_profiles.id', '=', 'users.id')   
                    ->leftJoin('usr_login_roles', 'usr_login_roles.id_login', '=', 'users.id') 
                    ->leftJoin('usr_roles', 'usr_login_roles.id_login', '=', 'usr_roles.id')        
                    ->select('usr_profiles.*', 'usr_roles.title as roles','users.email as email')    
                     ->groupBy('users.id')        
                    ->orderBy('usr_profiles.name','DESC')->paginate(20);


                return view('usuario.index',compact('users'));

            }
            if($idusuarioactual==0 || $idusuariomodulorol==0)
            {
                $flag="1";
                Session::flash('message','Debe otorgarle al menos un permiso a este usuario sobre este modulo, puede acceder en el menu Usuarios->configuracion'); 
                $users = DB::table('usr_profiles')
                    ->leftJoin('users', 'usr_profiles.id', '=', 'users.id')   
                    ->leftJoin('usr_login_roles', 'usr_login_roles.id_login', '=', 'users.id') 
                    ->leftJoin('usr_roles', 'usr_login_roles.id_login', '=', 'usr_roles.id')        
                    ->select('usr_profiles.*', 'usr_roles.title as roles','users.email as email')    
                     ->groupBy('users.id')        
                    ->orderBy('usr_profiles.name','DESC')->paginate(20);


               return view('usuario.index',compact('users'));
            }
            else
            {
                $json=$request['jsn'];
                specialpermission::create([
                                'id_user'=>$idusuarioactual,
                                'id_usermolrol'=>$idusuariomodulorol,
                                'active'=>'1',
                                'access'=>$json,
                                'register_by'=>Auth::User()->id,
                                'modify_by'=>Auth::User()->id,
                            ]);
            }
                        
                             
            $roles = DB::table('usr_roles')->where('active',1)->lists('title', 'id');
            $modulos=DB::table('sys_modules')->whereid_parent(0)->whereactive(1)->get();
            $submodulos=DB::table('sys_modules')->whereactive(1)->where('id_parent','>',0)->get();

            Session::flash('message','Permisos agregado correctamente'); 

            $flag="1";
           
            $users = DB::table('usr_profiles')
                ->leftJoin('users', 'usr_profiles.id', '=', 'users.id')   
                ->leftJoin('usr_login_roles', 'usr_login_roles.id_login', '=', 'users.id') 
                ->leftJoin('usr_roles', 'usr_login_roles.id_login', '=', 'usr_roles.id')        
                ->select('usr_profiles.*', 'usr_roles.title as roles','users.email as email')    
                 ->groupBy('users.id')        
                ->orderBy('usr_profiles.name','DESC')->paginate(20);


              return view('usuario.index',compact('users'));
        }

        else
        {
            $idModulo=$request['boton'];
            $idusuarioactual=$request['idusuarioactual'];

            $nModul=DB::table('sys_modules')->where('id',$idModulo)->first();
            $nModuls=str_replace(" ","-",trim($nModul->title));
            $path="";
            $path="admin.".$nModuls;
           
           
           if($request['id']!=null)
           {

            $idRole=$request['id'];

            $idusuariomodulorol=0;
            $nRol=DB::table('usr_roles')->where('id',$idRole)->first();
            $nombreRol=$nRol->title;
            $nModulo=DB::table('sys_modules')->where('id',$idModulo)->first();
            $idusermolrol=DB::table('user_module_rol')->whereid_role($idRole)->whereid_sysmodules($idModulo)->first();
            if($idusermolrol!=null)
            {$idusuariomodulorol=$idusermolrol->id;}

            if($nModulo!=null)
            {$nombreModulo=$nModulo->title;}else{$nombreModulo="";}
            
            $json=DB::table('special_permissions')->whereid_user($idusuarioactual)->whereid_usermolrol($idusuariomodulorol)->first();

            if($json!=null)
            {$json=json_decode($json->access,true);}else{$json="";}
            $b=1;
           
            if($json=="")
            {
               //$json=DB::table('cms_accesses')->whereid_sysmodule($idModulo)->whereactive(1)->select('title','active')->get();
               $b=1;
            $json=DB::table('cms_accesses')->select('title')->whereid_sysmodule($idModulo)->whereactive(1)->first();
                $json=json_decode($json->title,true);
            }
             
            return View::make('specialpermission.registerPermission',compact('idRole','idModulo','nombreRol','nombreModulo','json','path','b','idusuarioactual'));
            }

            else
            {
                $idRole=0;
                $idModulo=0;
                $nombreRol="";
                $nombreModulo="";
                $json="";
                $path="";
                $b=0;

                return View::make('specialPermission.registerPermission',compact('idRole','idModulo','nombreRol','nombreModulo','json','path','b'));
            }
      
        }
        /*if($request['idr']!=null && $request['idm']!=null&& $request['b']==0)
        { 
            $json=$request['jsn'];
            $mr=DB::table('user_module_rol')->whereid_role($request['idr'])->whereid_sysmodules($request['idm'])->first();
            $idmr=$mr->id;

            $v=DB::table('special_permissions')->whereid_user($request['idu'])->whereid_usermolrol($idmr)->first();
            if($v!=null)
            {
                $query=DB::table('special_permissions')->whereid($v->id)->update(array('access' => $json));
            }

            else
            { 
                $json=$request['jsn'];
                $mr=DB::table('user_module_rol')->whereid_role($request['idr'])->whereid_sysmodules($request['idm'])->first();
                $idmr=$mr->id;
                specialpermission::create([
                                'id_user'=>$request['idu'],
                                'id_usermolrol'=>$idmr,
                                'access'=>$json,
                                'active'=>'1',
                                'register_by'=>Auth::User()->id,
                                'modify_by'=>Auth::User()->id,
                            ]);
            }
                        
                             
            $roles = DB::table('usr_roles')->where('active',1)->lists('title', 'id');
            $modulos=DB::table('sys_modules')->whereid_parent(0)->whereactive(1)->get();
            $submodulos=DB::table('sys_modules')->whereactive(1)->where('id_parent','>',0)->get();

            return View::make('configuracion.index',compact('roles','modulos','submodulos'));
        }

        else
        {
            $json=$request['jsn'];
            $query=DB::table('special_permissions')->whereid_user($request['idu'])->whereid_usermolrol($request['idm'])->update(array('access' => $json));

            $idModulo=$request['boton'];

            $id=$request['idu'];
            $nombre=DB::table('usr_profiles')->where('id',$id)->first();
            $nombreCompleto=$nombre->name." ".$nombre->lastname;
            $id=$nombre->id;

            $rolesmodules=DB::table('user_module_rol')->where('active',1)->orderBy('id_role','ASC')->paginate(20);
            $roles=DB::table('usr_roles')->where('active',1)->get();
            $modules=DB::table('sys_modules')->where('active',1)->get();
          
        return View::make('specialPermission/index',compact('nombreCompleto','id','rolesmodules','roles','modules'));
        }*/
	}

    public function index($id)
    {
        if(Gate::denies('Usuarios.ModulodeUsuarios'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('Usuarios.SubmodulodeUsuarios'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('Usuarios.Asignarpermisosespeciales'))
        {
          Auth::logout();
          return Redirect('login');
        }

        $roles = DB::table('usr_roles')->where('active',1)->lists('title', 'id');
        $modulos=DB::table('sys_modules')->whereid_parent(0)->whereactive(1)->get();
        $submodulos=DB::table('sys_modules')->whereactive(1)->where('id_parent','>',0)->get();

        return View::make('specialpermission.index',compact('roles','modulos','submodulos','id'));

        /*
         $nombre=DB::table('usr_profiles')->where('id',$id)->first();
         $nombreCompleto=$nombre->name." ".$nombre->lastname;
         $id=$nombre->id;

         $rolesmodules=DB::table('user_module_rol')->where('active',1)->orderBy('id_role','ASC')->paginate(20);
         $roles=DB::table('usr_roles')->where('active',1)->get();
         $modules=DB::table('sys_modules')->where('active',1)->get();
          
        return View::make('specialPermission/index',compact('nombreCompleto','id','rolesmodules','roles','modules'));
        */
    }

    public function edit($idu,$idr,$idm)
    {
        if(Gate::denies('Usuarios.ModulodeUsuarios'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('Usuarios.SubmodulodeUsuarios'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('Usuarios.Asignarpermisosespeciales'))
        {
          Auth::logout();
          return Redirect('login');
        }
        
        $v=DB::table('user_module_rol')->whereid_role($idr)->whereid_sysmodules($idm)->first();
        if($v!=null){ $idmr=$v->id;}else{ $idmr=0;}

        $jsonp=DB::table('special_permissions')->whereid_user($idu)->whereid_usermolrol($idmr)->first();
        
        if($jsonp!=null)
        {
            $json=$jsonp->access;
            $json=json_decode($json,true);
        }

        else
        {
         $json = DB::table('user_module_rol')->whereid_role($idr)->whereid_sysmodules($idm)->first();
         if($json->access_granted!=null){$json=json_decode($json->access_granted,true);}
         else{$json="";}
        }

        $nRol=DB::table('usr_roles')->where('id',$idr)->first();
        $nombreRol=$nRol->title;
        $nModulo=DB::table('sys_modules')->where('id',$idm)->first();
        if($nModulo!=null){  
        $nombreModulo=$nModulo->title;}else{$nombreModulo="";}
        $b=DB::table('special_permissions')->whereid_user($idu)->whereid_usermolrol($idm)->first();
        if($b!=null){$b=1;}else{$b=0;}

        return View::make('specialPermission/registerpermission',compact('json','nombreRol','nombreModulo','idr','idm','idu','b'));
    }
}
