<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Rediect;
use Session;
use Illuminate\Routing\Route;
use DB;
use App;

class PosadaParaisoController extends Controller
{
  
    public function __construct(Request $request){
       if(session('lang')!=null)
          App::setLocale(session('lang'));/*Asigno el idioma a laravel para este controlador*/
        else
          App::setLocale('es');
       $language=App::getLocale();/*Obtengo el idioma definido en laravel*/
       $this->id_language=DB::table('cms_language')->where('code','=', $language)->max('id'); 

    }
    
    public function index(Request $request)
    {
        $uri=trans('posadapraiso/secciones.historia');/*Ago la traduccion con el diccionario en esta ruta*/
        $sectionHistory = null;
        $sectionHistory =  DB::table('cms_sections')->where('id_language','=',$this->id_language)->where('uri','=', $uri)->where('publish','=',1)->where('active','=',1)->first();             
       
        $uri=trans('posadapraiso/secciones.contacto');
        $sectionContact = null;
        $sectionContact =  DB::table('cms_sections')->where('id_language','=',$this->id_language)->where('uri','=', $uri)->where('publish','=',1)->where('active','=',1)->first();   
        
        $uri=trans('posadapraiso/secciones.ubicacion');
        $sectionLocation = null;
        $sectionLocation =  DB::table('cms_sections')->where('id_language','=',$this->id_language)->where('uri','=', $uri)->where('publish','=',1)->where('active','=',1)->first();   
        
        /*Cargo el albúm para el slider de la parte de arriba de la pagina*/
        $album="Album principal";//nombre del albúm que se le dio en el panel de administración
        $flag='1';  
        $band='1';  
        $publish='1';  
        $media=null;

        $media =  DB::table('med_albums')
            ->join('med_pictures', 'med_albums.id', '=', 'med_pictures.id_album')            
            ->select('med_albums.*', 'med_pictures.path as pic', 'med_pictures.id_album as idal')        
            ->where('med_albums.active','=', $flag)
            ->where('med_albums.publish','=', $publish)
            ->where('med_pictures.active','=', $flag)   
            ->where('med_pictures.publish','=',$publish)
            ->where('med_albums.title','=',$album)        
            ->orderBy('med_albums.order_by','DESC')->paginate(20);

        return view('posadaparaiso.home',['sectionHistory'=>$sectionHistory,'sectionContact'=>$sectionContact,'sectionLocation'=> $sectionLocation,'media'=>$media]);
    
    }
    public function restaurant(){
         
        $uri=trans('posadapraiso/secciones.restaurante');
        $sectionRestaurant = null;
        $sectionRestaurant =  DB::table('cms_sections')->where('id_language','=',$this->id_language)->where('uri','=', $uri)->where('publish','=',1)->where('active','=',1)->first();   
     
        $uri=trans('posadapraiso/secciones.habitaciones');
        $sectionRooms = null;
        $sectionRooms =  DB::table('cms_sections')->where('id_language','=',$this->id_language)->where('uri','=', $uri)->where('publish','=',1)->where('active','=',1)->first();   
        
        $album="Restaurante";
        $flag='1';  
        $band='1';  
        $publish='1';  
        $media=null;

         $media =  DB::table('med_albums')
            ->join('med_pictures', 'med_albums.id', '=', 'med_pictures.id_album')            
            ->select('med_albums.*', 'med_pictures.path as pic', 'med_pictures.id_album as idal')        
            ->where('med_albums.active','=', $flag)
            ->where('med_albums.publish','=', $publish)
            ->where('med_pictures.active','=', $flag)   
            ->where('med_pictures.publish','=',$publish)
            ->where('med_albums.title','=',$album)        
            ->orderBy('med_albums.order_by','DESC')->paginate(20);

        return view('posadaparaiso.restaurant',['sectionRestaurant'=>$sectionRestaurant,'sectionRooms'=>$sectionRooms,'media'=>$media]);
    
    }

    public function hotel(){
        $uri=trans('posadapraiso/secciones.hotel');
        $sectionHotel = null;
        $sectionHotel =  DB::table('cms_sections')->where('id_language','=',$this->id_language)->where('uri','=', $uri)->where('publish','=',1)->where('active','=',1)->first();   
     

        $album="hotel";//nombre del albúm que se le dio en el panel de administración
        $flag='1';  
        $band='1';  
        $publish='1';  
        $media=null;

        $media =  DB::table('med_albums')
            ->join('med_pictures', 'med_albums.id', '=', 'med_pictures.id_album')            
            ->select('med_albums.*', 'med_pictures.path as pic', 'med_pictures.id_album as idal')        
            ->where('med_albums.active','=', $flag)
            ->where('med_albums.publish','=', $publish)
            ->where('med_pictures.active','=', $flag)   
            ->where('med_pictures.publish','=',$publish)
            ->where('med_albums.title','=',$album)        
            ->orderBy('med_albums.order_by','DESC')->paginate(20);
         
        return view('posadaparaiso.hotel',['sectionHotel'=>$sectionHotel,'media'=>$media]);
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
            //$uris = $this->getBreadcrumb($request);
           $uris="/bnm";

               dd($media);
             

            return view('cresolido.galery',['media'=>$media ,'band'=>$band, 'uris'=>$uris] );
    }

    public function galleries(){
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

                 return view('cresolido.galery',['items'=>$items, 'band'=>$band, 'uris'=>$uris] );
    } 


    public function Setings(Request $request)
    {
        $Setps= DB::table('cms_senttingspages')->get(); 
        return view('cresolido.index',['Setps'=>$Setps]);
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
