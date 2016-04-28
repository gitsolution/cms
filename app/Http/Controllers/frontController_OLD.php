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

class frontController extends Controller
{
  /*
   public function __construct()
    {
        $this->middleware('auth');
    }
  */    
  
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

            return view('frontend.contacto');
    }

    public function storess(Request $request)
    {
        $user = new App\med_pictures;
        $user->where('uri', '=', '/store/56d8804ca914f/56d882f53f735.png')->update(['publish' => '0']);
        dd($request);
    }
    


    public function Contacto()
    {
        return view('frontend.contacto');
    }

    public function cotizacion()
    {
        return view('frontend.frmcotizacion');
    }


public function index()
    {
        $flag=1;
        $private=1;
        $publish=1;

        $Sections = null;
        $Categories = null;
        $uri='Inicio';
        
        
        $id_section =  (DB::table('cms_sections')->where('active','=', $flag)->where('uri','=', $uri)->max('id'));             
      
          $Sections =  DB::table('cms_sections')->where('active','=', $flag)->where('publish','=', $publish)->where('id','=', $id_section)->get();             
      
            $Categories = DB::table('cms_categories')
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')            
            ->select('cms_categories.*', 'cms_sections.title as section')
            ->where('cms_categories.active','=', $flag)                    
            ->where('cms_categories.id_section','=', $id_section)                        
            ->where('cms_categories.publish','=', $publish)                                    
            ->orderBy('order_by','DESC')->paginate(20);

            $this->aumentarHits($uri);

            return view('frontend.home',['Categories'=>$Categories, 'Sections'=>$Sections]);
    }

    public function BlogList()
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

            return view('frontend.blog',['Documents'=>$Documents, 'Categories'=>$Categories, 'Sections'=>$Sections]);
    }



    public function Blog($post)
    {
        $flag=1;
        $Sections = null;
        $Categories = null;
        $uri=$post;
        
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
            
            return view('frontend.blog',['Documents'=>$Documents, 'Categories'=>$Categories, 'Sections'=>$Sections,'post'=>$post, 'coments'=>$coments, 'cont'=>$ContComments]);
}


public function page(Request $request)
    {   
           $uri  = $request->path();
           if( $uri=='admin'){
    	       return view('home');
            }
      		else{
            $flag=1;
            $Sections = null;
            $Categories = null;               
                         
            $Sections = DB::table('cms_sections')->where('active','=', $flag)->where('uri','=', $uri)->get();

            $this->aumentarHits($uri);

            return view('frontend.page',['Categories'=>$Categories, 'Sections'=>$Sections]);
           }
  	 
       
       }



public function section($option){
        $flag=1;
        $publish = 1;
        $Sections = null;
        $Categories = null;
        $uri=$option;
        
        $id_section =  (DB::table('cms_sections')->where('active','=', $flag)->where('uri','=', $uri)->max('id'));                   
        $Sections =  DB::table('cms_sections')->where('active','=', $flag)->where('publish','=', $publish)->where('id','=', $id_section)->get();             

        $this->aumentarHits($uri);
         
         return view('frontend.section',['Sections'=>$Sections]);

}

public function category($option){
        $Sections = null;
        $Categories = null;
        $uri=$option;
                
            $Categories = DB::table('cms_categories')
            ->join('cms_sections', 'cms_categories.id_section', '=', 'cms_sections.id')            
            ->select('cms_categories.*', 'cms_sections.title as section')
            ->where('cms_categories.active','=', $flag)            
            ->where('cms_categories.uri','=', $uri)                        
            ->orderBy('order_by','DESC')->paginate(20);

            $this->aumentarHits($uri);
            
            return view('frontend.category',['Categories'=>$Categories]);

}

public function document($option){


            $Documents = null;
            $uri=$option;
            $Documents = DB::table('cms_documents')
            ->where('cms_documents.active','=', $flag)            
            ->where('cms_documents.uri','=', $uri)                        
            ->orderBy('order_by','DESC')->get();

            $this->aumentarHits($uri);

            return view('frontend.documents',['Documents'=>$Documents]);

        
}

public function listCategory($option){
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
            
            return view('frontend.category',['Categories'=>$Categories]);

}

public function listDocument($option){

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

            return view('frontend.documents',['Documents'=>$Documents]);

}
public function listGalleries(){
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

          
            return view('frontend.galery',[/*'items'=>$items,*/ 'media'=>$media ,'band'=>$band] );

}

public function galleries($option){
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

            $this->aumentarHits($uri);

   return view('frontend.galery',['items'=>$items, 'band'=>$band] );
}

    public function Setings()
    {
        $Setps= DB::table('cms_senttingspages')->get(); 
        return view('frontend.index',['Setps'=>$Setps]);
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
 

 
 
}
