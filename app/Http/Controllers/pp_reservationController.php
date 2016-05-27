<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
use App\Http\Controllers\PaypalController;

use Route;
use Auth;
use Gate;
use Redirect;


class pp_reservationController extends Controller
{      
  public function __construct(Request $request){
       if(session('lang')!=null)
          App::setLocale(session('lang'));/*Asigno el idioma a laravel para este controlador*/
        else
          App::setLocale('es');
       $language=App::getLocale();/*Obtengo el idioma definido en laravel*/
       $this->id_language=DB::table('cms_language')->where('code','=', $language)->max('id'); 

  }
    
  public function index()
  {
         $reservations = DB::table('pp_reservation')->paginate(20);             
      
         return view('posadaparaiso/reservations/index',['reservations'=>$reservations]);
  }
  
  public function store(Request $request){
     
    $arrayItemToPay=unserialize($request['arrayItemToPay']);
    $arrayItemToPay['total']= $request['total'];
    $num_hab=$arrayItemToPay["habitacion"];


    $arrayIdPricesHab=$request['precios'];

    $arrayItemToPay;
    $arrayIdPricesHab;


    /*$arrayItemToPay = array(
      'nombre'=>$request['nombre'],
      'llegada'=>$request['llegada'],
      'salida'=>$request['salida'],
      'habitacion'=>$request['habitacion'],
      'adultos'=>$request['adultos'],
      'menores'=>$request['menores'],
      'promo'=>$request['promo'],

    );*/
     /*LLama al controlador paypal  para que valide el pago antes de guardarlos en la basede datos*/
    $request2 = Request::create('/callPaypalMethod', 'GET',$arrayItemToPay);
    return Route::dispatch($request2)->getContent();    
 
    }
    public function reservationDetails(Request $request){
    
   
    $arrayItemToPay = array(
      'nombre'=>$request['nombre'],
      'llegada'=>$request['llegada'],
      'salida'=>$request['salida'],
      'habitacion'=>$request['habitacion'],
      'adultos'=>$request['adultos'],
      'menores'=>$request['menores'],
      'promo'=>$request['promo'],
    );
    
    $objPrices=new pp_pricesController(); 
    $dataPrices=$objPrices->getPricesActive();
    
    /*$arrayItems=array();//para llenar el select 
    foreach ($dataPrices as $price) {
      $arrayItems[ $price->id] = $price->type_room;
    }*/

    return view('posadaparaiso.payReservation',['arrayItemToPay'=>$arrayItemToPay,'dataPrices'=>$dataPrices]); 
    } 

    public function getReservationDetails($id){
      if(Gate::denies('Reservaciones.ReservacionesPagadas'))
      {
        Auth::logout();
        return Redirect('login');
      }

      if(Gate::denies('Reservaciones.Reservacionesverdetalles'))
      {
        Auth::logout();
        return Redirect('login');
      }

      $id_reservation=$id;
          $detailsReservation = DB::table('pp_reservation')
            ->join('pp_details_reservation', 'pp_details_reservation.id_reservation', '=', 'pp_reservation.id')
            ->join('pp_prices', 'pp_details_reservation.id_price', '=', 'pp_prices.id')            
            ->where('pp_details_reservation.id_reservation','=',$id_reservation)
            //->select('cms_categories.*', 'cms_sections.title as section')                                                   
            ->orderBy('pp_reservation.arrival','DESC')->paginate(20);  
         
         return view('posadaparaiso/reservations/details',['detailsReservation'=>$detailsReservation]);
    }


    public function serviceReservation(Request $request){
     //return response()->json($request,200);
     
     $tokenServer="23asdfghjt5432345678tre";
       if($request['token']==$tokenServer){
           $Data = DB::table('pp_reservation')->get();  
          return response()->json($Data,200);
       }
     else
        return response()->json("Erroor",400);
     
    }
}
