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
    
  public function index()
  {
      if(Gate::denies('Reservaciones.ReservacionesPagadas'))
      {
        Auth::logout();
        return Redirect('login');
      }
   
         $reservations = DB::table('pp_reservation')->paginate(20);             
      
         return view('posadaparaiso/reservations/index',['reservations'=>$reservations]);
  }
  
  public function store(Request $request){
   if(Gate::denies('Reservaciones.ReservacionesPagadas'))
    {
      Auth::logout();
      return Redirect('login');
    }

    $arrayItemToPay=unserialize($request['arrayItemToPay']);
    $arrayItemToPay['total']= $request['total'];
    $num_hab=$arrayItemToPay["habitacion"];


    $arrayIdPricesHab=$request['precios'];
    /*for($i=0;$i<$num_hab;$i++){
        $arrayIdPricesHab[$i];
    }
    dd($array);*/

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
    if(Gate::denies('Reservaciones.ReservacionesPagadas'))
    {
      Auth::logout();
      return Redirect('login');
    }
   
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

    public function SendpayReservationToPaypal(Request $request){
           
         
    }

}
