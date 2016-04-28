<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\userRequest;
use Redirect;
use Session;
use DB;
use App\User;
use App\usr_login_role;
use App\usr_profile;
use App\Http\Controllers\Controller;
use Mail;
use Auth;

class usuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
	{	
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

   

    public function create()
    {
    	return view('usuario.create');
    }

    public function edit($id)
    {
        $user = DB::table('usr_profiles')
            ->Join('users', 'usr_profiles.id', '=', 'users.id')         
            ->select('users.*', 'usr_profiles.name as name','usr_profiles.lastname as lastName')    
            ->where('users.id', '=', $id)->first();
        
        return view('usuario/create')->with('user',$user);
    }
    
    /***guardar usuario***/
    public function store(userRequest $request)
    {     
        $activado='0';
        if($request ['ChekActivacion']== "on")
        {
            $activado='1';
        }

    	User::create([
    		'name'=>$request['name'],
            'lastName'=>$request['lastName'],
    		'email'=>$request['email'],
    		'password'=>($request['password']),//bcrypt
            'active'=>$activado,
            'register_by'=>Auth::User()->id,
            'modify_by'=>Auth::User()->id,
    	]);
        
        $usr=DB::table('users')->where('email',$request->email)->select('id')->first();
            $perfil = new usr_profile;
            $perfil->id=$usr->id;
            $perfil->name=$request->name;
            $perfil->lastname=$request->lastName;
            $perfil->save();
       
           Session::flash('message','Usuario Registrado Correctamente');     
           return Redirect::to("usuario");
        /*return Redirect::to("/admin/userNew")
        ->with("message", "Hemos enviado un enlace de confirmación a su 
                cuenta de correo electrónico");*/
    }

    public function register(Request $request)
    {
        User::create([
            'name'=>$request['name'],
            'lastName'=>$request['lastName'],
            'email'=>$request['email'],
            'password'=>($request['password']),//bcrypt
            'active'=>'1',
        ]);

        return Redirect::to("login");
    }

    public function update($id,Request $request){
        $activado='0';
        if($request ['ChekActivacion']== "on")
        {
            $activado='1';
        }

        $user = User::find($id);
        $user->fill($request->all()); 
        $user->active=$activado;     
        $user->modify_by=Auth::User()->id;
        $user->save();

        $userProfile = usr_profile::find($id);
        $userProfile->name=$request['name'];  
        $userProfile->lastname=$request['lastName'];      
        $userProfile->save();
        
        Session::flash('message','Usuario Actualizado Correctamente');    
        return Redirect::to("usuario");
    }

    public function delete($id)
    {
        $query=User::destroy($id);

        return view('usuario.index');
    }

    
}
