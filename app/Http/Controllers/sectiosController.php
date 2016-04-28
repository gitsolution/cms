<?php

namespace App\Http\Controllers;

use Storage;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
use Session;
use Redirect;
use Auth;
use Gate;
use App;
class sectiosController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }  
    
  public function index()
   {
        if(Gate::denies('Secciones.SubmodulodeSecciones'))
        {   
           abort(401);
        }

        else
        {
          $flag='1';  
       
          $Sections = DB::table('cms_sections')
                  ->join('cms_types', 'cms_types.id', '=', 'cms_sections.id_type')            
                  ->select('cms_sections.*', 'cms_types.title as type')
                  ->where('cms_sections.active','=', $flag)            
                  ->orderBy('order_by','DESC')->paginate(20);
                  return view('sections/index',compact('Sections'));
          }

   }


  public function section()
    {
        $types = \App\cms_type::All();
        $Sections=null;
        return view('sections.sectionform',['Sections'=>$Sections,'types'=>$types]);
    }

    
  public  function store(Request $request)
    {   
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
      $flag=1;
      $orderBy =  (DB::table('cms_sections')->where('active','=', $flag)->max('order_by'))+1;
    
      $file = $request->file('file');    
      if($file!=""){ 
      $path='store/SEC/'.uniqid().'.'.$file->getClientOriginalExtension();
      //indicamos que queremos guardar un nuevo archivo en el disco local
       Storage::disk('local')->put($path,  File::get($file));
      }
      else
      {
        $path="";
      }
        $uri=str_replace(" ","-",trim($request['title']));
        //Obtenemos la uri en base al titulo  
        $uri=$this->string2url($uri);//
        //Generamos una Uri única
        $table='cms_sections';
        $uri=$this->validateFriendlyUri($uri,$table);


		  \App\cms_section::create([
          'id_type'=>$request['id_type'],
          'id_language'=>$request['id_language'],
          'title' => $request['title'],
          'resumen'=>$request['resumen'],
          'content'=>$request['content'],
          'main_picture'=> $path,
          'private'=>$ChekPrivad,
          'publish_date'=>$request['publish_date'],//$request['descripcion'],
          'publish'=>$ChekPubli,
          'uri'=>$uri,//$request['descripcion'],
          'order_by'=>$orderBy,//$request['descripcion'],
          'active'=>'1',//$request[''],
          'register_by'=>Auth::User()->id,
          'modify_by'=>Auth::User()->id,
      
          ]);
                      

          return redirect('admin/sections');
      }

       function validateFriendlyUri($uri, $table){
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
          $types = \App\cms_type::All();
          $Section = \App\cms_section::find($id);
          return view('sections.sectionform',['Section'=>$Section, 'types'=>$types]);
      }


  public function update($id, Request $request)
      {
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
            
            $isUpImg=false;
            $Section = \App\cms_section::find($id);                      
            $path=null;
            $file = $request->file('file');               
           
       

        

            if($file!=""){
            $main_picture=$Section->main_picture;

            $path='store/SEC/'.uniqid().'.'.$file->getClientOriginalExtension();                        
            
            if($main_picture!=$path)
            {
              $isUpImg=true;
              //indicamos que queremos guardar un nuevo archivo en el disco local
              Storage::disk('local')->put($path,  File::get($file));

            }
            }
          
            $Section->fill($request->all());
            if($isUpImg)
            {
              $Section->main_picture=$path;
            }
 
            $Section->private=$ChekPrivad;
            $Section->publish=$ChekPubli;
            $Section->modify_by=Auth::User()->id;
            $Section->save();
            Session::flash('message','Seccion Actualizada Correctamente');    
            return redirect('admin/sections');       
      }


      public function deletePicture($id)
      {

          $types = \App\cms_type::All();
          $Section = \App\cms_section::find($id);
          $Section->main_picture="";
          $Section->save();
          Session::flash('message','Imagen Eliminada Correctamente'); 
          return view('sections.sectionform',['Section'=>$Section, 'types'=>$types]);

      }


  public function delete($id)
      {
          $Section = \App\cms_section::find($id);
          $Section->active=0;
          $Section->save();
          Session::flash('message','Sección Eliminada Correctamente');    
          return redirect('/admin/sections');
      }

  public function order($id, $orderBy, $no)
      {
          // Actualizamos el registro con id
          $flag=1;
          $this->setOrderItem($flag,$orderBy, $no);
  
          $Section = \App\cms_section::find($id);
          $Section->order_by=$no;
          $Section->save();   
         
          return redirect('/admin/sections');
  }

  public function setOrderItem($flag,$orderBy, $no)
  {
    $noAux=$no;
    $Section = DB::table('cms_sections')->where('active','=', $flag)->where('order_by', '=',$no)->get();    
    if($orderBy=='Up'){ 
      $noAux=$noAux-1;
      }else {     
      $noAux=$noAux+1;      
    }
    $Section =  Null; 
    $Section = DB::table('cms_sections')->where('active','=', $flag)->where('order_by', '=',$no)->update(['order_by'=>$noAux]);   
  }


  public function privado($id,$priv){
    $flag=1;
    
    if($priv=='True'){ $priv = 1;}else{ $priv = 0; }
    $Section = DB::table('cms_sections')->where('active','=', $flag)->where('id', '=',$id)->update(['private'=>$priv]);             
      
    return redirect('/admin/sections');
  }

  public function publicate($id,$pub){
    $flag=1;
    if($pub=='True'){ $pub = 1;}else{ $pub = 0; }
    $Section = DB::table('cms_sections')->where('active','=', $flag)->where('id', '=',$id)->update(['publish'=>$pub]);             
     
    return redirect('/admin/sections');
  }


    public function getData($id){
          $Sections = DB::table('cms_sections')
            ->select('cms_sections.id', 'cms_sections.title as section')
            ->where('cms_sections.active','=', $flag)            
            ->orderBy('order_by','DESC')->get();
            return $Sections;
    }


}
