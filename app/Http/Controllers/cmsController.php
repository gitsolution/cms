<?php
namespace App\Http\Controllers;
use Redirect;
use Session;
use DB;
use App\sys_module;
use App\cms_access;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use View;

class cmsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {           
        $id=$request['idModule'];
        cms_access::create([
                    'id_sysmodule'=>$request['idModule'],
                    'title'=>$request['name'],
                    'description'=>$request['description'],
                    'active'=>'1',
                    'register_by'=>Auth::User()->id,
                    'modify_by'=>Auth::User()->id,
                ]);

            $nModule=DB::table('sys_modules')->where('id',$id)->first();
            $nameModule=$nModule->title;
            $permiso=DB::table('cms_accesses')->where('id_sysmodule',$id)->whereactive(1)->get();  

             Session::flash('message','Permiso agregado correctamente');            
        return View::make('sysmodules/modulespermission',compact('id','nameModule','permiso'));  
    }

    public function index()
    {
        return View('admin/cms');
    }

    public function activar($id,$idaccess,$active)
    {
        if($active=='True')
        { 
            $active = 1;
        }

        else
        { 
            $active = 0; 
        }

         DB::update('update cms_accesses set active = ?, modify_by = ?  where id = ? ',array($active, Auth::User()->id,$idaccess));

        $nModule=DB::table('sys_modules')->where('id',$id)->first();
        $nameModule=$nModule->title;
        $permiso=DB::table('cms_accesses')->where('id_sysmodule',$id)->get();  

       return View::make('sysmodules/modulespermission',compact('id','nameModule','permiso'));  
    }

}
