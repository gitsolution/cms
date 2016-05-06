<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
use App\Http\Controllers\PaypalController;

use Route;

class pp_reservationController extends Controller
{      
     public function store(Request $request){
   
    $arrayItemToPay = array(
      'nombre'=>$request['nombre'],
      'llegada'=>$request['llegada'],
      'salida'=>$request['salida'],
      'habitacion'=>$request['habitacion'],
      'adultos'=>$request['adultos'],
      'menores'=>$request['menores'],
      'promo'=>$request['promo'],
    );
    
   /*LLama al controlador paypal  para que valide el pago antes de guardarlos en la basede datos*/
    $request2 = Request::create('/callPaypalMethod', 'GET',$arrayItemToPay);
    return Route::dispatch($request2)->getContent();
   
    
    } 

}
