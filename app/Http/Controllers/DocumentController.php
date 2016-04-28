<?php

namespace App\Http\Controllers;

use Storage;
use File;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
use View;
use Session;
use Redirect;

class DocumentController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
    
  	 public function index()
   		{
    	   	$flag='1';  
             $Document = DB::table('cms_documents')
            ->join('cms_categories', 'cms_categories.id', '=', 'cms_documents.id_category')
            ->select('cms_documents.*', 'cms_categories.title as category')
            ->where('cms_documents.active','=', $flag)
            ->orderBy('order_by','DESC')->paginate(20);    
        	return view('documents/index',compact('Document'));

        


   		}
	 public function documentynew()
	 {      
      $flag = 1;

      $Sections = DB::table('cms_sections')->get();   

      $Categories = DB::table('cms_categories')->where('active','=', $flag)->get();   


    		//return view('documents/documentform');
        return view('documents.documentform',['Sections'=>$Sections,'Categories'=>$Categories]);

    
    }

     public function store(Request $request)
    	{
          $flag=1;
       		$ChekPubli='0';
        	if($request ['ChekPublicar']== 'on')
        	{
          		$ChekPubli='1';
        	}	

        	$ChekPrivad='0';
        	if($request ['ChekPrivado']== 'on')   
       		{
         		$ChekPrivad='1';
        	}
 
          $orderBy =  (DB::table('cms_documents')->where('active','=', $flag)->max('order_by'))+1;    
          $file = $request->file('file');   
 
          if($file!=""){       
          $file = $request->file('file');   
          $path ='store/DOC/'.uniqid().'.'.$file->getClientOriginalExtension();
          //indicamos que queremos guardar un nuevo archivo en el disco local
           Storage::disk('local')->put($path,  File::get($file));
          }
          else{
            $path="";
          }


        $uri=str_replace(" ","-",trim($request['title']));
        //Obtenemos la uri en base al titulo  
        $uri=$this->string2url($uri);//
        //Generamos una Uri única
        $table='cms_documents';
        $uri=$this->validateFriendlyUri($uri,$table);


             \App\cms_document::create([
          	'id_category' => $request['id_category'],
          	'title' => $request['title'],
          	'resumen'=>$request['resumen'],
          	'content'=>$request['content'],
          	'main_picture'=>$path,
          	'private'=>$ChekPrivad,
          	'publish_date'=>$request['publish_date'],
          	'publish'=>$ChekPubli,
          	'hits'=>'0',
          	'uri'=>$uri,
          	'order_by'=>$orderBy,
          	'active'=>'1',
          	'register_by'=>Auth::User()->id,
          	'modify_by'=>Auth::User()->id,
          	
          	]);
             Session::flash('message','Documento creado con exito');               
          	return redirect('admin/document');
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


     public function edit($id)
   		{
       	
         $flag = 1;

        $Document = \App\cms_document::find($id);

        $Category = \App\cms_category::find($Document->id_category);
        $Sections = DB::table('cms_sections')->get();   
        $Categories = DB::table('cms_categories')->where('active','=', $flag)->where('id_section','=', $Category->id_section)->get(); 
        return view('documents.documentform',['Sections'=>$Sections,'Categories'=>$Categories, 'Document'=>$Document]);
     	


      }
     
     public function update($id, Request $request)
     	{
           
            $isUpImg=false;
            $Document = \App\cms_document::find($id);
            $path=null;

            $file = $request->file('file');    
              $ChekPubli='0';
        if($request ['ChekPublicar']== 'on')
        {
          $ChekPubli='1';
        }

        $ChekPrivad='0';
        if($request ['ChekPrivado']== 'on')   
       {
         $ChekPrivad='1';
        }

            if($file!=""){
           
            $main_picture=$Document->main_picture;

            $path='store/DOC/'.uniqid().'.'.$file->getClientOriginalExtension();                        
            
              if($main_picture!=$path)
              {
                $isUpImg=true;
                //indicamos que queremos guardar un nuevo archivo en el disco local
                Storage::disk('local')->put($path,  File::get($file));

              }
            }
          
            $Document->fill($request->all());            
            if($isUpImg){
            $Document->main_picture=$path;
            }

            $Document->private=$ChekPrivad;
            $Document->publish=$ChekPubli;
            $Document->modify_by=Auth::User()->id;
           	$Document->save();
           	Session::flash('message','Documento Actualizado Correctamente');    
           	return redirect('admin/document');       
     	}
     public function delete($id)
	    {
          	$Document = \App\cms_document::find($id);
          	$Document->active=0;
          	$Document->save();
        	  Session::flash('message','Documento Eliminado Correctamente');    
      	    return redirect('admin/document')->with('message','store');
        }

    public function deletePicture($id)
      {
        $flag=1;
         $Document = \App\cms_document::find($id);
        $Category = \App\cms_category::find($Document->id_category);
        $Sections = DB::table('cms_sections')->get();   
        $Categories = DB::table('cms_categories')->where('active','=', $flag)->where('id_section','=', $Category->id_section)->get(); 
     
          $Document->main_picture="";
          $Document->save();
          Session::flash('message','Imagen Eliminada Correctamente');      
        return view('documents.documentform',['Sections'=>$Sections,'Categories'=>$Categories, 'Document'=>$Document]);
     


      }




  	 public function privado($id,$priv)
  		{
    		$flag=1;
    
    		if($priv=='True'){ $priv = 1;}else{ $priv = 0; }
    		$Document = DB::table('cms_documents')->where('active','=', $flag)->where('id', '=',$id)->update(['private'=>$priv]);             
      		Session::flash('message','Ordén del Albúm actualizado');    
    		return redirect('/admin/document')->with('message','store');
  		}
  	 public function publicate($id,$pub)
  	 	{
    		$flag=1;
    		if($pub=='True'){ $pub = 1;}else{ $pub = 0; }
    		$Document = DB::table('cms_documents')->where('active','=', $flag)->where('id', '=',$id)->update(['publish'=>$pub]);    
    		Session::flash('message','Ordén del Albúm actualizado');
    		return redirect('/admin/document')->with('message','store');
  		}
  	 public function order($id, $orderBy, $no)
    	{
        	// Actualizamos el registro con id
         	$flag=1;
          	$this->setOrderItem($flag,$orderBy, $no);
          	$Document = \App\cms_document::find($id);
          	$Document->order_by=$no;
          	$Document->save();   
          	Session::flash('message','Ordén del Albúm actualizado');    
          	return redirect('/admin/document')->with('message','store');
  		}


     public function getCategories($id_section, Request $request)
      {
        $Categories=null;
        if($request->ajax()){
          $flag=1;
          $Categories = DB::table('cms_categories')->where('active','=', $flag)->where('id_section', '=',$id_section)->get();     
          return response()->json($Categories);
       }  
      }


     public function getEditCategories($no, $id_section, Request $request)
      {
        $Categories=null;
        if($request->ajax()){
          $flag=1;
          $Categories = DB::table('cms_categories')->where('active','=', $flag)->where('id_section', '=',$id_section)->get();     
          return response()->json($Categories);
       }  
      }

  	public function setOrderItem($flag,$orderBy, $no)
  		{
    		$noAux=$no;
    		$Document = DB::table('cms_documents')->where('active','=', $flag)->where('order_by', '=',$no)->get();    
    		if($orderBy=='Up')
    		{ 
      			$noAux=$noAux-1;
      		}
      	else 
      		{     
      			$noAux=$noAux+1;      
    		}
        	var_dump($noAux);
    		$Document =  Null; 
    		$Document = DB::table('cms_documents')->where('active','=', $flag)->where('order_by', '=',$no)->update(['order_by'=>$noAux]);   
 		}
    
}
