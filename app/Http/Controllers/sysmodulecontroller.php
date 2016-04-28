<?php

namespace App\Http\Controllers;
use Redirect;
use Session;
use DB;
use App\sys_module;
use Illuminate\Http\Request;
use Auth;
use View;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class sysmodulecontroller extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
	{	$flag=1;
		$cms = sys_module::All();
        $cms =  DB::table('sys_modules')->whereactive($flag)->where('id_parent','=',0)->orderBy('id','DESC')->paginate(20);
		return view('sysmodules.index',compact('cms'));	
	}

	public function store(Request $request)
    {    	    	
    	$activado='0';
        if($request ['ChekActivacion']== "on")
        {
        	//echo "El check esta activado";
          	$activado='1';
        }

    	sys_module::create([
            'id_parent'=>'0',
    		'title'=>$request['title'],
            'description'=>$request['description'],
    		'active'=>'1',
            'register_by'=>Auth::User()->id,
            'modify_by'=>Auth::User()->id,
    	]);
        
        Session::flash('message','Módulo agregado correctamente');    
        
       	return Redirect::to("admin/module");
    }

    public function create()
    {
    	return view('sysmodules.cmsForm');
    }

    public function edit($id)
    {
        $cms=sys_module::find($id);
        return view('sysmodules.cmsform',['cms'=>$cms]);
    }

    public function editpermision($id)
    {
        $nModule=DB::table('sys_modules')->where('id',$id)->first();
        $nameModule=$nModule->title;
        /*$permiso=DB::table('cms_accesses')->whereid_sysmodule($id)->first();
        return View::make('sysmodules/modulespermission',compact('id','nameModule','permiso'));*/
        $permiso=DB::table('cms_accesses')->select('title')->whereid_sysmodule($id)->first(); 
        $json=json_decode($permiso->title,True);
        return View::make('sysmodules/modulespermission',compact('id','nameModule','permiso','json'));
    }

    public function update($id,Request $request){
        $activado='0';
        if($request ['ChekActivacion']== "on")
        {
            $activado='1';
        }

        $cms = sys_module::find($id);
        $cms->active='1';
        $cms->fill($request->all());      
        $cms->save();
           
        Session::flash('message','Módulo actualizado correctamente');    

        return Redirect::to("admin/module");
    }

    public function activar($id,$active)
    {
        $priv=1;    
        if($active=='True')
        { 
            $active = 1;
        }

        else
        { $active = 0; }

        $modules = DB::table('sys_modules')->where('id', '=',$id)->update(['active'=>'0']);
        $submodules = DB::table('sys_modules')->where('id_parent', '=',$id)->update(['active'=>'0']);             
        Session::flash('message','Módulo eliminado');    
        return redirect('/admin/module');
    }

}
