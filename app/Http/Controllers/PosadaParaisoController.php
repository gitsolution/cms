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
            ->orderBy('med_albums.order_by','DESC')->get();

        return view('posadaparaiso.home',['sectionHistory'=>$sectionHistory,'sectionContact'=>$sectionContact,'sectionLocation'=> $sectionLocation,'media'=>$media]);
    
    }
    public function restaurant(){
         
        $uri=trans('posadapraiso/secciones.restaurante');
        $sectionRestaurant = null;
        $sectionRestaurant =  DB::table('cms_sections')->where('id_language','=',$this->id_language)->where('uri','=', $uri)->where('publish','=',1)->where('active','=',1)->first();   
     
        $uri=trans('posadapraiso/secciones.habitaciones');
        $sectionRooms = null;
        $sectionRooms =  DB::table('cms_sections')->where('id_language','=',$this->id_language)->where('uri','=', $uri)->where('publish','=',1)->where('active','=',1)->first();   
        
        $album="Restaurante";//(para el slider del Header)
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
            ->orderBy('med_albums.order_by','DESC')->get();

        return view('posadaparaiso.restaurant',['sectionRestaurant'=>$sectionRestaurant,'sectionRooms'=>$sectionRooms,'media'=>$media]);
    
    }

    public function hotel(){
        $uri=trans('posadapraiso/secciones.hotel');
        $sectionHotel = null;
        $sectionHotel =  DB::table('cms_sections')->where('id_language','=',$this->id_language)->where('uri','=', $uri)->where('publish','=',1)->where('active','=',1)->first();   
     
       //(para el slider del Header)
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
            ->orderBy('med_albums.order_by','DESC')->get();

        $albumGaleryHotel=null;
        $album="hotel";//para la galeria
        $albumGaleryHotel =  DB::table('med_albums')
            ->join('med_pictures', 'med_albums.id', '=', 'med_pictures.id_album')            
            ->select('med_albums.*', 'med_pictures.path as pic', 'med_pictures.id_album as idal')        
            ->where('med_albums.active','=', $flag)
            ->where('med_albums.publish','=', $publish)
            ->where('med_pictures.active','=', $flag)   
            ->where('med_pictures.publish','=',$publish)
            ->where('med_albums.title','=',$album)        
            ->orderBy('med_albums.order_by','DESC')->simplePaginate(20);
           
         //   $albumGaleryHotel->setPath('Hotel/Gallery');


        $albumGaleryRooms=null;
        $album="habitaciones";//para la galeria
        $albumGaleryRooms =  DB::table('med_albums')
            ->join('med_pictures', 'med_albums.id', '=', 'med_pictures.id_album')            
            ->select('med_albums.*', 'med_pictures.path as pic', 'med_pictures.id_album as idal')        
            ->where('med_albums.active','=', $flag)
            ->where('med_albums.publish','=', $publish)
            ->where('med_pictures.active','=', $flag)   
            ->where('med_pictures.publish','=',$publish)
            ->where('med_albums.title','=',$album)        
            ->orderBy('med_albums.order_by','DESC')->paginate(20);
         
        return view('posadaparaiso.hotel',['sectionHotel'=>$sectionHotel,'media'=>$media,'albumGaleryHotel'=>$albumGaleryHotel,'albumGaleryRooms'=>$albumGaleryRooms]);
    }




}
