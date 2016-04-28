<?php

namespace App\Http\Controllers;
use File;
use Illuminate\Http\Request;
use Storage;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class perfilController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
    
  	public function index()
  	{
  		return view('usuario.perfil');
  	}

    public function store(Request $request)
    { 
    	$publish= 0;
		  $index_page=0;

		$file = $request->file('file');    
      if($file!=""){ 
      $path='store/user/'.uniqid().'.'.$file->getClientOriginalExtension();
      //indicamos que queremos guardar un nuevo archivo en el disco local
       Storage::disk('local')->put($path,  File::get($file));
      }
      else
      {
        $path="";
      }

	   $flag=1;	   	 

			\App\usr_profile::create([
			'id'=>Auth::user()->id,
			'name'=>$request['name'],	
			'lastname'=>$request['lastname'],	
			'picture'=>$path,	
			'gender'=>$request['gender'],
			'born_date'=>$request['born_date'],
			]);
		return view('layouts.app');
    }

    public function update($id,Request $request)
    {
            $isUpImg=false;
            $user = \App\usr_profile::find($id);  
                      
            $path=null;
            $file = $request->file('file');   

            if($file!="")
            {
                $picture=$user->picture;

                $path='store/user/'.uniqid().'.'.$file->getClientOriginalExtension();                        
                
                if($picture!=$path)
                {
                  $isUpImg=true;
                  //indicamos que queremos guardar un nuevo archivo en el disco local
                  Storage::disk('local')->put($path,  File::get($file));
                }
            }


            $user->fill($request->all());
            if($isUpImg){
            $user->picture=$path;
            }

            $user->save();
            

        return view('layouts.app');

    }

    public function perfil()
    {
      $idUsuario=Auth::user()->id;
      $user = \App\usr_profile::find($idUsuario);  
      return view('usuario.perfil',compact('user'));
    }
}
