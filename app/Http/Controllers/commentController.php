<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use view;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gate;
use Auth;

class commentController extends Controller
{	  
        public function __construct()
    {
        $this->middleware('auth',['only'=>['index','publicate','delete']]);
    }  
    
  public function index()
   {
    if(Gate::denies('Comentarios.SubmodulodeComentarios'))
    {
      Auth::logout();
      return redirect('/Inicio');
    }

    $flag='1';  
 
    $Coments = DB::table('cms_comments')
      ->join('cms_documents', 'cms_documents.id', '=', 'cms_comments.id_document')            
      ->select('cms_comments.*', 'cms_documents.title as titleDoc')
      ->where('cms_comments.active','=', $flag)            
      ->orderBy('created_at','DESC')->paginate(20);
      return view('comments/index',compact('Coments'));

   }

      public function store(Request $request){
          $uri=$request->uri;         
    	  \App\cms_comment::create([
          
          'id_comment'=>$request['id_doment'],
          
          'id_document' => $request['id_doc'],
          'mail'=>$request['mail'],
          'content'=>$request['content'],
           'publish'=>'0',
           'active'=>'1',
         ]);
         Session::flash('message','Tu comentario sera autorizado por el administrador de la pagina');    
    	  return redirect('Blog/'.$uri);
    }

  public function publicate($id,$pub){
    if(Gate::denies('Comentarios.SubmodulodeComentarios'))
      {Auth::logout();return redirect('/Inicio');
      }
    if(Gate::denies('Comentarios.Publicar'))
    { Auth::logout();return redirect('/Inicio');
    }
    $flag=1;
    if($pub=='True'){ $pub = 1;}else{ $pub = 0; }
    $Coments = DB::table('cms_comments')->where('active','=', $flag)->where('id', '=',$id)->update(['publish'=>$pub]);             
     
    return redirect('admin/comments');
  }

  public function delete($id)
      {
        if(Gate::denies('Comentarios.SubmodulodeComentarios'))
        {
          Auth::logout();
          return redirect('/Inicio');
        }
        if(Gate::denies('Comentarios.Eliminar'))
        {
          Auth::logout();
          return redirect('/Inicio');
        }

          $Coments = \App\cms_comment::find($id);
          $Coments->active=0;
          $Coments->save();
          Session::flash('message','Comentario Eliminado Correctamente');    
          return redirect('admin/comments');
      }

      public function respuesta($id, $uri){
        $ids=$id;
        $uris=$uri;
        $band=1;
       
       //['itemMenus'=>$itemMenus,'menu'=>$menu, 'id_parent'=>$id_parent, "level"=>$level]
       return redirect('Blog/'.$uris)->with('band',$ids);
      }

}
