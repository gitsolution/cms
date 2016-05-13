<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use MP;



class mercadopagoController extends Controller
{
    public function postPayment(Request $request)//Metodo para enviar a Paypal
    {    
    if($request['total']==0 || $request['total']==null )
        return redirect('Inicio')//Si por alguna razon no hay un precio total para enviar a paypal 
        ->with('message', 'Lo sentimos, Reservaciones no disponible en estos momentos');

    $arrayItemToPay=unserialize($request['arrayItemToPay']);
    //$arrayItemToPay['total']= $request['total'];
    $num_hab=$arrayItemToPay["habitacion"];
    //dd($arrayItemToPay["habitacion"]);
    $arrayIdPricesHab=$request['precios'];
    
    /*for($i=0;$i<$num_hab;$i++){
        echo $arrayIdPricesHab[$i];
    }*/

     $arrayItemToPay;
     $arrayIdPricesHab;


      $price=$request['total'];
     
      $name_client=$arrayItemToPay['nombre'];
      $llegada=$arrayItemToPay['llegada'];
      $salida=$arrayItemToPay['salida'];
      $habitacion=$arrayItemToPay['habitacion'];
      $adultos=$arrayItemToPay['adultos'];
      $menores=$arrayItemToPay['menores'];
      $promo=$arrayItemToPay['promo'];
    
     
      $name='Reservación';
      $extract='Reservacion en Hotel posada paraíso';
      $quantity='1';
      
     
      $costoDeEnvio=0;
    
      $mp = new MP("3763616876393218", "yfjYtjoDXWQowRZ9kZSSBNFHD7jgeCpF");
     /* $preference_data = array (
        "items" => array (
          array (
            "title" => "Test",
            "quantity" => 1,
            "currency_id" => "USD",
            "unit_price" => 10.4
          )
        )
      );
     
      $preference = $mp->create_preference($preference_data);
      print_r ($preference);
      */

      //$access_token = $mp->get_access_token();
      //print_r ($access_token);

    }
}

