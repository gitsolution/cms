<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\contactoRequest;
use App\Http\Controllers\Controller;
use Mail;
use App\cms_section;
use App\cms_category;
use App\cms_document;
use App\Media;
use App\Item;
use App\Directory;
use App\ItemFiles;

class moldeandoController extends Controller
{

    public function store(contactoRequest $request)
    {
            $data['name']=$request['name'];
            $data['email']=$request['email'];
            $data['phone']=$request['phone'];
            $data['asunt']=$request['asunt'];

            Mail::send('mails.contacto', ['data' => $data], function($mail)
                use($data){
                 $mail->subject('Comentario');
                 $mail->to('analista_de_credito@hotmail.com')->bcc('romanalbores@gmail.com');
            });

            return view('moldeando.contacto');
    }
    


    public function Contacto(Request $request)
    {
        $uris = $this->getBreadcrumb($request);
        return view('moldeando.contacto',['uris'=>$uris]);
    }

    public function cotizacion(Request $request)
    {
        $uris = $this->getBreadcrumb($request);
        return view('moldeando.frmcotizacion',['uris'=>$uris]);
    }


public function index(Request $request)
    {
        $flag=1;
        $private=1;
        $publish=1;

        $Sections = null;
        $Categories = null;
        $uri='Inicio';
        
        

            
            $Categories = DB::table('cms_categories')
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')            
            ->select('cms_categories.*', 'cms_sections.title as section')
            ->where('cms_categories.active','=', $flag)
            ->where('cms_sections.uri','=', 'Inicio')                     
            ->where('cms_categories.publish','=', $publish)                                    
            ->orderBy('order_by','DESC')->paginate(4);
            
            $CategoriesNoti = DB::table('cms_categories')
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')            
            ->select('cms_categories.*', 'cms_sections.title as section')
            ->where('cms_categories.active','=', $flag)  
            ->where('cms_sections.uri','=', 'Noticias')                
            ->where('cms_categories.publish','=', $publish)                                    
            ->orderBy('order_by','DESC')->get();

            $CategoriesEvent = DB::table('cms_categories')
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')            
            ->select('cms_categories.*', 'cms_sections.title as section')
            ->where('cms_categories.active','=', $flag)  
            ->where('cms_sections.uri','=', 'Eventos')                
            ->where('cms_categories.publish','=', $publish)                                    
            ->orderBy('order_by','DESC')->get();

            $CategoriesPro = DB::table('cms_categories')
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')            
            ->select('cms_categories.*', 'cms_sections.title as section')
            ->where('cms_categories.active','=', $flag)  
            ->where('cms_sections.uri','=', 'Proyectos')                
            ->where('cms_categories.publish','=', $publish)                                    
            ->orderBy('order_by','DESC')->get();
            
            $this->aumentarHits($uri);
            $uris = $this->getBreadcrumb($request);
            
            return view('moldeando.home',['Categories'=>$Categories,'uris'=>$uris, 'eventos'=>$CategoriesEvent, 'noticias'=>$CategoriesNoti,'proyectos'=>$CategoriesPro]);
    }

    public function BlogList(Request $request)
    {
        $flag=1;
        $Sections = null;
        $Categories = null;
        $Documents = null;
        $uri='Blog';
        
        $id_section =  (DB::table('cms_sections')->where('active','=', $flag)->where('uri','=', $uri)->max('id'));             
        $Sections = \App\cms_section::find($id_section);
        $Categories =  DB::table('cms_categories')->where('active','=', $flag)->where('id_section','=', $id_section)->get();             

            $Documents = DB::table('cms_documents')
            ->join('cms_categories', 'cms_documents.id_category', '=', 'cms_categories.id')                        
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')
            ->select('cms_documents.*', 'cms_sections.id as id_section', 'cms_sections.title as section','cms_categories.title as category')
            ->where('cms_documents.active','=', $flag)            
           // ->where('cms_categories.id_section','=', $id_section)                        
            ->orderBy('cms_documents.order_by','DESC')->paginate(20);
            
            $this->aumentarHits($uri);
            $uris = $this->getBreadcrumb($request);
            return view('moldeando.blog',['Documents'=>$Documents, 'Categories'=>$Categories, 'Sections'=>$Sections, 'uris'=>$uris]);
    }



    public function Blog($post, Request $request)
    {
        $flag=1;
        $Sections = null;
        $Categories = null;
        $uri='Blog';
        
        $id_section =  (DB::table('cms_sections')->where('active','=', $flag)->where('uri','=', $uri)->max('id'));             
        $Sections = \App\cms_section::find($id_section);

        $Categories =  DB::table('cms_categories')->where('active','=', $flag)->where('id_section','=', $id_section)->get();             

            $Documents = DB::table('cms_documents')
            ->join('cms_categories', 'cms_documents.id_category', '=', 'cms_categories.id')                        
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')
            ->select('cms_documents.*', 'cms_sections.id as id_section', 'cms_sections.title as section','cms_categories.title as category')
            ->where('cms_documents.active','=', $flag)
            ->where('cms_documents.uri','=', $post)
            ->orderBy('order_by','DESC')->get();

            $this->aumentarHits($uri);
            
           $coments= DB::table('cms_comments')
                ->join('cms_documents','cms_documents.id','=','cms_comments.id_document')
                ->select('cms_comments.*','cms_documents.id as iddoc')
                ->where('cms_comments.publish','=','1')
                ->where('cms_comments.active','=','1')
                ->orderby('created_at','DESC')->get();
        
                $ContComments = DB::table('cms_comments')
                     ->select(DB::raw('count(id) as user_count'))
                     ->where('active', '=', 1)
                     ->where('publish', '=', 1)
                     ->first();
            $uris = $this->getBreadcrumb($request);
           

            return view('moldeando.blog',['Documents'=>$Documents, 'Categories'=>$Categories, 'Sections'=>$Sections,'post'=>$post, 'coments'=>$coments, 'cont'=>$ContComments,'uris'=>$uris]);
}


public function page(Request $request)
    {   
        $uri  = $request->path();
           if( $uri=='admin'){
               return view('home');
            }
            else{
            $flag=1;
            $publish=1;
            $Sections = null;

                
            $Sections = DB::table('cms_sections')->where('active','=', $flag)->where('uri','=', $uri)->get();        
            $Sectionscat = DB::table('cms_sections')->where('active','=', $flag)->where('uri','=', $uri)->first();
            if($Sectionscat==null){
                 $idsection=0;
                 $mapauri='0';
            }
            else{
            $idsection=$Sectionscat->id;
            $mapauri=$Sectionscat->uri;
            }
            
            
            
            
            $Categories = DB::table('cms_categories')
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')            
            ->select('cms_categories.*', 'cms_sections.title as section')
            ->where('cms_categories.active','=', $flag)            
            ->where('cms_categories.publish','=', $publish) 
            ->where('cms_categories.id_section','=', $idsection)                        
            ->orderBy('order_by','DESC')->get();
            
                

            $this->aumentarHits($uri);
            $uris = $this->getBreadcrumb($request);

            return view('moldeando.page',['Sections'=>$Sections, 'uris'=>$uris, 'Categories'=>$Categories, 'mapa'=>$mapauri]);
           }            
       }



public function section($option, Request $request){
        $flag=1;
        $publish = 1;
        $Sections = null;
        $Categories = null;
        $uri=$option;
        
        $id_section =  (DB::table('cms_sections')->where('active','=', $flag)->where('uri','=', $uri)->max('id'));                   
        $Sections =  DB::table('cms_sections')->where('active','=', $flag)->where('publish','=', $publish)->where('id','=', $id_section)->get();             

        $this->aumentarHits($uri);
        $uris = $this->getBreadcrumb($request);
         
        return view('moldeando.section',['Sections'=>$Sections, 'uris'=>$uris]);

}

public function category($option, Request $request){
        $Sections = null;
        $flag=1;
        $Categories = null;
        $uri=$option;

                
            $Categories = DB::table('cms_categories')
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')            
            ->select('cms_categories.*', 'cms_sections.title as section')
            ->where('cms_categories.active','=', $flag)            
            ->where('cms_categories.uri','=', $uri)                        
            ->orderBy('order_by','DESC')->paginate(20);

             $Popular = DB::table('cms_categories')
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')            
            ->select('cms_categories.*', 'cms_sections.title as section')
            ->where('cms_categories.active','=', $flag)            
            ->orderBy('hits','DESC')->paginate(5);

            $this->aumentarHits($uri);
            $uris = $this->getBreadcrumb($request);
            
            return view('moldeando.category',['Categories'=>$Categories, 'Popular'=>$Popular]);
}

public function document($option, Request $request){

            $Documents = null;
            $uri=$option;
        
            $Documents = DB::table('cms_documents')
            ->where('cms_documents.active','=', $flag)            
            ->where('cms_documents.uri','=', $uri)                        
            ->orderBy('order_by','DESC')->get();

            $this->aumentarHits($uri);
            $uris = $this->getBreadcrumb($request);
            
            return view('moldeando.documents',['Documents'=>$Documents, 'uris'=>$uris]);        
}

public function listCategory($option, Request $request){
        $Sections = null;
        $Categories = null;
        $uri=$option;
        $flag = 1;
        
        $id_section =  (DB::table('cms_sections')->where('active','=', $flag)->where('uri','=', $uri)->max('id'));             
        
            $Categories = DB::table('cms_categories')
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')            
            ->select('cms_categories.*', 'cms_sections.title as section')
            ->where('cms_categories.active','=', $flag)            
            ->where('cms_categories.id_section','=', $id_section)                        
            ->orderBy('order_by','DESC')->paginate(20);

            $this->aumentarHits($uri);
            $uris = $this->getBreadcrumb($request);
            return view('moldeando.category',['Categories'=>$Categories, 'uris'=>$uris]);
}

public function listDocument($option, Request $request){

        $Sections = null;
        $Categories = null;
        $uri=$option;

        $id_category =  (DB::table('cms_categories')->where('active','=', $flag)->where('uri','=', $uri)->max('id'));             


            $Documents = DB::table('cms_documents')
            ->join('cms_sections', 'cms_documents.id_category', '=', 'cms_categories.id')            
            ->select('cms_documents.*', 'cms_categories.title as section')
            ->where('cms_documents.active','=', $flag)            
            ->where('cms_documents.id_category','=', $id_category)                        
            ->orderBy('order_by','DESC')->paginate(20);

            $this->aumentarHits($uri);
            $uris = $this->getBreadcrumb($request);
            return view('moldeando.documents',['Documents'=>$Documents, 'uris'=>$uris]);

}
public function listGalleries(Request $request){
        $flag='1';  
        $band='1';  
        $publish='1';  
      

        $media =  DB::table('med_albums')
            ->join('med_pictures', 'med_albums.id', '=', 'med_pictures.id_album')            
            ->select('med_albums.*', 'med_pictures.path as pic', 'med_pictures.id_album as idal')        
            ->where('med_albums.active','=', $flag)
            ->where('med_albums.publish','=', $publish)
            ->where('med_pictures.active','=', $flag)   
            ->where('med_pictures.publish','=',$publish)        
            ->orderBy('med_albums.order_by','DESC')->paginate(20);
            $uris = $this->getBreadcrumb($request);

           
            return view('moldeando.galery',['media'=>$media ,'band'=>$band, 'uris'=>$uris] );
}

public function galleries($option, Request $request){
        $uri = $option;    
        $flag='1';  
        $publish='1';  
        $band='0';  
        
        $items =  DB::table('med_pictures')
            ->join('med_albums', 'med_pictures.id_album', '=', 'med_albums.id')            
            ->select('med_pictures.*', 'med_albums.title as album')        
            ->where('med_albums.active','=', $flag)
            ->where('med_albums.publish','=', $publish)
            ->where('med_pictures.active','=', $flag) 
            ->where('med_albums.uri','=',$uri)  
            ->where('med_pictures.publish','=',$publish)      
            ->orderBy('med_pictures.order_by','DESC')->paginate(20);
            $uris = $this->getBreadcrumb($request);
            $this->aumentarHits($uri);
   return view('moldeando.galery',['items'=>$items, 'band'=>$band, 'uris'=>$uris] );
}

    public function Setings(Request $request)
    {
        $Setps= DB::table('cms_senttingspages')->get(); 
        return view('moldeando.index',['Setps'=>$Setps]);
    }


    public function aumentarHits($uri)
    {
               
        /*********** Hits section ************/
            $modulo = new cms_section;
            $modulo->whereuri($uri)->whereactive(1)
            ->increment('hits');
        /****************************/

        /*********** Hits para categoria ******/
            $categories = new cms_category;
            $categories ->whereuri($uri)->whereactive(1)
            ->increment('hits');
        /****************************/

        /*********** Hits para documents ******/
            $document = new cms_document;
            $document ->whereuri($uri)->whereactive(1)
            ->increment('hits');
        /****************************/

        /*********** Hits para med_albums ******/
            $media = new Media;
            $media ->whereuri($uri)->whereactive(1)
            ->increment('hits');
        /****************************/
        
        /*********** Hits para med_pictures ******/
            $media = new Item;
            $media ->whereuri($uri)->whereactive(1)
            ->increment('hits');
        /****************************/
    }

    public function getBreadcrumb(Request $request){        
        $uris = explode("/",$request->path());
        $ahref= "";
        

        /*for($i=0;$i<count($uris);$i++){
        $ahref=$ahref+$uris[$i];
                if((count($uris)-1)==$i)
                {
                    $uris[$i]="{!!link_to(".$ahref.",".$ahref.",array('class'=>'nav-link')) !!}";
                    break;
                }
                else{
                $ahref=$ahref+"/";
                }               
            $uris[$i]="link_to(".$ahref.",".$ahref.",array('class'=>'nav-link'))";
        }*/
        return $uris; 
    } 


}
