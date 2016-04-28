<?php

namespace App\Http\Controllers;
use Storage;
use File;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use DB;


class ItemFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index($id_directory){

		$flag='1';	
		$directories=\App\Directory::find($id_directory); 	
		$itemFiles =  DB::table('sys_files')
		    ->join('sys_directories', 'sys_files.id_directory', '=', 'sys_directories.id')            
            ->select('sys_files.*', 'sys_directories.title as directory')        
        	->where('sys_files.active','=', $flag)
        	->where('id_directory','=',$id_directory)->orderBy('sys_files.order_by','DESC')->paginate(20);
			return view('itemfiles/index',['itemFiles'=>$itemFiles,'directories'=>$directories]);				
	}

	public function itemnew($id_directory){
		$flag='1';	 
	    $directories=\App\Directory::find($id_directory);	    
		$itemFiles= null;
        return view('itemfiles/itemFilesform',['itemFiles'=>$itemFiles,'directories'=>$directories]);		
	}


	public function create($id_directory){	
		$flag='1';	
		$directories = DB::table('sys_directories')->where('active','=', $flag)->orderBy('order_by','DESC')->get();
		$itemFiles = null;		
        return view('itemfiles.itemform',['itemFiles'=>$itemFiles,'directories'=>$directories]);	
	}


	public function store(Request $request){
		$publish= 0;
		$index_page=0;
		$extension="";
		if($request['publish']=='on')
		{
			$publish=1;
		}



		if($request['index_page']=='on')
		{
			$index_page=1;
		}
		     //obtenemos el campo file definido en el formulario
       	  $flag=1;
          $orderBy =  (DB::table('sys_files')->where('active','=', $flag)->max('order_by'))+1;
          $file = $request->file('file');     
     

          if($file!=""){       
          $directories = \App\Directory::find($request->id_directory);
		  $path=$directories->path.uniqid().'.'.$file->getClientOriginalExtension();
          $extension = $file->getClientOriginalExtension();
          //indicamos que queremos guardar un nuevo archivo en el disco local
           Storage::disk('local')->put($path,  File::get($file));
          }
          else{
            $path="";
          }



 	   $flag=1;	   
       $orderBy =  (DB::table('sys_files')->where('active','=', $flag)->max('order_by'))+1;		 
			\App\ItemFile::create([
			'id_directory'=>$request['id_directory'],	
			'title'=>$request['title'],
			'description'=>$request['description'],
			'uri'=>$path,
			'publish'=>$publish,
			'publish_date'=>$request['publish_date'],
			'path'=>$path,
			'mime_type'=>$extension,
			'extension'=>$extension,
			'hits'=>'0',//$request['hits'],
			'order_by'=>$orderBy,			
			'active'=>'1',//$request['active'],
			'register_by'=>'1',//$request['resgiter_by'],
			'modify_by'=>'1',//$request['modify_by'], 
			]);

		return redirect('/admin/itemFiles/'.$request->id_directory);


	}


	public function showItems($id_directory){
		$directories= \App\Directory::find($id_directory);
		$flag='1';	
		$itemFiles =  DB::table('sys_files')->where('active','=', $flag)->where('id_album','=',$id_album)->orderBy('order_by','DESC')->paginate(20);
		return view('itemFiles/index',compact('itemFiles'));
	}

	public function show($id){
		$flag='1';	
		$itemFiles =  DB::table('sys_files')->where('active','=', $flag)->orderBy('order_by','DESC')->paginate(20);
		return view('itemfiles/index',compact('itemFiles'));
	}



	public function edit($id){
		$flag='1';	
		$itemFiles =  \App\ItemFile::find($id); 	

		$directories = \App\Directory::find($itemFiles->id_directory); 		

        return view('itemfiles/itemFilesform',['itemFiles'=>$itemFiles,'directories'=>$directories]);		
    	}

	public function update($id,Request $request){
         $publish= 0;
		if($request['publish']=='on')
		{
			$publish=1;
		}

         $isUpFile=false;
  		 $itemFiles = \App\ItemFile::find($id);		 
         $directories = \App\Directory::find($itemFiles->id_directory);
            $path=null;
            $file = $request->file('file');    

            if($file!=""){
            $archive=$itemFiles->path;

            $path = $directories->path.uniqid().'.'.$file->getClientOriginalExtension();                                    
            

              if($archive!=$path)
              {

                $isUpFile=true;
                //indicamos que queremos guardar un nuevo archivo en el disco local
                Storage::disk('local')->put($path,  File::get($file));

              }
            }
          
            $itemFiles->fill($request->all());            
            if($isUpFile){
	            $itemFiles->path=$path;               
            }    
        $itemFiles->publish=$publish;
 		$itemFiles->save();
		Session::flash('message','Archivo Actualizado Correctamente');		
		return redirect('/admin/itemFiles/'.$itemFiles->id_directory);
	}

	public function delete($id){
        $itemFiles = \App\ItemFile::find($id);
		$itemFiles->active=0;
		$itemFiles->save();
		Session::flash('message','Archivo Eliminado Correctamente');		

		return redirect('/admin/itemFiles/'.$itemFiles->id_directory);

	}

    public function deleteFile($id)
      {
          $itemFiles= \App\ItemFile::find($id);
          $directories = \App\Directory::find($itemFiles->id_directory);
          $itemFiles->path="";
          $itemFiles->save();
          Session::flash('message','Imagen Eliminada Correctamente');           
          return redirect('/admin/itemFilesedit/'.$itemFiles->id);
      }




	public function order($id, $orderBy, $no){
		// Actualizamos el registro con id
		$flag=1;
		$this->setOrderItem($flag,$orderBy, $no);
	
		$itemFiles = \App\ItemFile::find($id);
		$itemFiles->order_by=$no;
		$itemFiles->save();		
		Session::flash('message','Ordén del los archivos actualizado');		

		return redirect('/admin/itemFiles/'.$itemFiles->id_directory);

	}


/*	public function validarArchivos(){

		$a = ("","","","","","","","","","");
	}
*/

	public function setOrderItem($flag,$orderBy,$no)
	{
		$noAux=$no;
		$itemFiles = DB::table('sys_files')->where('active','=', $flag)->where('order_by', '=',$no)->get();		
		if($orderBy=='Up'){	
			$noAux=$noAux-1;
			}else { 		
			$noAux=$noAux+1;			
		}
		$itemFiles =  Null;	
		$itemFiles= DB::table('sys_files')->where('active','=', $flag)->where('order_by', '=',$no)->update(['order_by'=>$noAux]);			
	}

	public function publicate($id,$pub){
		$flag=1;
		if($pub=='True'){ $pub = 1;}else{ $pub = 0; }
		$itemFiles = DB::table('sys_files')->where('active','=', $flag)->where('id', '=',$id)->update(['publish'=>$pub]);			       
	   	$itemFiles = null;
	    $itemFiles=\App\ItemFile::find($id);	
	    Session::flash('message','Ordén de los archivos actualizado');		
		return redirect('/admin/itemFiles/'.$itemFiles->id_directory);
	}

	public function index_page($id,$ind){
       	$flag=1; 
			if($ind=='True'){ $ind = 1;}else{ $ind = 0; }
		$itemFiles = DB::table('sys_files')->where('active','=', $flag)->where('id', '=',$id)->update(['index_page'=>$ind]);			       

	    Session::flash('message','Ordén del archivo actualizado');		

		return redirect('/admin/itemFiles/'.$itemFiles->id_directory);

	
	}
	public function destroy($id)
	{
	
	}


}
