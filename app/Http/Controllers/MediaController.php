<?php

namespace App\Http\Controllers;

use Storage;
use Auth;
use File;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use DB;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index(){
		$flag='1';	
		$medias =  DB::table('med_albums')->where('active','=', $flag)->orderBy('order_by','DESC')->paginate(20);
		return view('media/index',compact('medias'));
	}

	public function medianew(){
		return view('media/mediaform');
	}


	public function create(){
		return view('mediaform');
	}


	public function store(Request $request){
		$publish= 0;
		$index_page=0;
		if($request['publish']='on')
		{
			$publish=1;
		}


		if($request['index_page']='on')
		{
			$index_page=1;
		}

		$path = '/store/'.uniqid().'/';
		//mkdir($path, 0700);
		Storage::disk('local')->makeDirectory($path);

		$uri=str_replace(" ","-",trim($request['title']));
        //Obtenemos la uri en base al titulo  
        $uri=$this->string2url($uri);//
        //Generamos una Uri única
        $table='med_albums';
        $uri=$this->validateFriendlyUri($uri,$table);


	   $flag=1;
       $orderBy =  (DB::table('med_albums')->where('active','=', $flag)->max('order_by'))+1;
 

			\App\Media::create([
			'title'=>$request['title'],
			'description'=>$request['content'],
			'order_by'=>$orderBy,
			'uri'=>$uri,
			'publish'=>$request['publish'],
			'publish_date'=>$request['publish_date'],
			'path'=>$path,
			'index_page'=>$index_page,
			'hits'=>'0',//$request['hits'],
			'active'=>'1',//$request['active'],
			'register_by'=>Auth::User()->id,
          	'modify_by'=>Auth::User()->id,
			]);
		return redirect('/admin/media')->with('message','store');
	}


     public static function validateFriendlyUri($uri, $table){
       $flag=1;
       $id=0;      
       $id = (DB::table($table)->where('active','=', $flag)->where('uri','=', $uri)->max('id'));   
        
        if($id>0){
          $uri=$uri.'-'.($id+1);
        }

        return $uri;
      }


      function string2url($cadena) {
        $cadena = trim($cadena);
        $arr1=array("À","Á","Â","Ã","Ä","Å","à","á","â","ã","ä","å","Ò","Ó","Ô","Õ","Ö","Ø","ò","ó","ô","õ","ö","ø","È","É","Ê","Ë","è","é","ê","ë","Ç","ç","Ì","Í","Î","Ï","ì","í","î","ï","Ù","Ú","Û","Ü","ù","ú","û","ü","ÿ","Ñ","ñ");
        $arr2=array("a","a","a","a","a","a","a","a","a","a","a","a","o","o","o","o","o","o","o","o","o","o","o","o","e","e","e","e","e","e","e","e","c","c","i","i","i","i","i","i","i","i","u","u","u","u","u","u","u","u","y","n","n");
        $cadena = str_replace($arr1,$arr2,$cadena);
       
        return $cadena;
      }

	public function show($id){

		return "SHOW ".$id;
	}

	public function edit($id){
			$media = \App\Media::find($id);
			return view('media/mediaform')->with('media',$media);
    	}

	public function update($id,Request $request){
		       $index_page='0';
        if($request ['index_page']== 'on')
        {
          $index_page='1';
        }

        $publish='0';
        if($request ['publish']== 'on')   
       {
         $publish='1';
        }


        $media = \App\Media::find($id);
		$media->fill($request->all());	
		$media->description=$request['content'];
		$media->index_page=$index_page;
        $media->publish=$publish;
        $media->modify_by=Auth::User()->id;


		$media->save();
		Session::flash('message','Usuario Actualizado Correctamente');		
		return redirect('/admin/media')->with('message','store');
	}

	public function delete($id){
        $media = \App\Media::find($id);
		$media->active=0;
		$media->save();
		Session::flash('message','Usuario Eliminado Correctamente');		
		return redirect('/admin/media')->with('message','store');
	}


	public function order($id, $orderBy, $no){
		// Actualizamos el registro con id
		$flag=1;
		$this->setOrderItem($flag,$orderBy, $no);
	
		$media = \App\Media::find($id);
		$media->order_by=$no;
		$media->save();		
		Session::flash('message','Ordén del Albúm actualizado');		
		return redirect('/admin/media')->with('message','store');
	}


	public function setOrderItem($flag,$orderBy, $no)
	{
		$noAux=$no;
		$media = DB::table('med_albums')->where('active','=', $flag)->where('order_by', '=',$no)->get();		
		if($orderBy=='Up'){	
			$noAux=$noAux-1;
			}else { 		
			$noAux=$noAux+1;			
		}
				var_dump($noAux);
		$media =  Null;	
		$media = DB::table('med_albums')->where('active','=', $flag)->where('order_by', '=',$no)->update(['order_by'=>$noAux]);		
	}

	public function publicate($id,$pub){
		$flag=1;
		if($pub=='True'){ $pub = 1;}else{ $pub = 0; }
		$media = DB::table('med_albums')->where('active','=', $flag)->where('id', '=',$id)->update(['publish'=>$pub]);			       
	    Session::flash('message','Ordén del Albúm actualizado');		
		return redirect('/admin/media')->with('message','store');
	}

  



	public function index_page($id,$ind){
       	$flag=1; 
			if($ind=='True'){ $ind = 1;}else{ $ind = 0; }
		$media = DB::table('med_albums')->where('active','=', $flag)->where('id', '=',$id)->update(['index_page'=>$ind]);			       
	    Session::flash('message','Ordén del Albúm actualizado');		
		return redirect('/admin/media')->with('message','store');
	
	}
	public function destroy($id)
	{
	
	}


}
