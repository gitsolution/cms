<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sys_module;
use View;
use DB;
use Auth;

class submenucontroller extends Controller
{
	public function store(Request $request)
	{
		$idMenu= $request['idMenu'];
		$activado='0';
        if($request ['ChekActivacion']== "on")
        {
        	//echo "El check esta activado";
          	$activado='1';
        }

    	sys_module::create([
            'id_parent'=>$idMenu,
    		'title'=>$request['title'],
            'description'=>$request['description'],
    		'active'=>'1',
            'register_by'=>Auth::User()->id,
            'modify_by'=>Auth::User()->id,
    	]);
        
        $flag=1;
		$cms =  DB::table('sys_modules')->whereactive($flag)->where('id_parent','=',$idMenu)->orderBy('id_parent','DESC')->paginate(20);

		Session::flash('message','Módulo agregado correctamente'); 
		return view('sysmodules.submodule',compact('cms','idMenu'));
	}

    public function index($idMenu)
    {
    	$flag=1;
		$cms =  DB::table('sys_modules')->whereactive($flag)->where('id_parent','=',$idMenu)->orderBy('id_parent','DESC')->paginate(20);

		return view('sysmodules.submodule',compact('cms','idMenu'));
	}

	public function update($id,Request $request)
     {dd($id);
        $cms = sys_module::find($id);
        $cms->active='1';
        $cms->fill($request->all());      
        $cms->save();
           
        Session::flash('message','Módulo actualizado correctamente');    

        return Redirect::to('/admin/submodules/'.$idmodule);
    }

	public function create($idMenu)
    {
    	return view('sysmodules.cmsForm',compact('idMenu'));
    }

    public function edit($id)
    {
        $cms=sys_module::find($id);
        $idsubmodule=$cms->id_parent;
        $msg="submenuedit";
        return view('sysmodules.cmsform',['cms'=>$cms,'msg'=>$msg,'idsubmodule'=>$idsubmodule]);
    }

    public function activar($id,$idmodule)
    {
        $modules = DB::table('sys_modules')->where('id', '=',$id)->update(['active'=>'0']);
        $submodules = DB::table('sys_modules')->where('id_parent', '=',$id)->update(['active'=>'0']);             
        Session::flash('message','Módulo eliminado');    
        return redirect('/admin/submodules/'.$idmodule);
    }
}
