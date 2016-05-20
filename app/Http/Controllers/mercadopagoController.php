<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use MP;

use URL;
use Session;
use DB;
use App\pp_reservation;
use App\pp_reservation_details;
use App;

class mercadopagoController extends Controller
{

    public $CLIENT_ID="850785406949633";
    public $CLIENT_SECRET="L9Iv1YaKRvHZtuKCgAdrrq86fFFApYbj";
    
    public function __construct()
    {
     //para los idiomas
     if(session('lang')!=null)
          App::setLocale(session('lang'));/*Asigno el idioma a laravel para este controlador*/
        else
          App::setLocale('es');
       $language=App::getLocale();/*Obtengo el idioma definido en laravel*/
       $this->id_language=DB::table('cms_language')->where('code','=', $language)->max('id'); 
    }
   

    public function postPayment(Request $request)//Metodo para enviar a Paypal
    {    
    if($request['total']==0 || $request['total']==null )
        return redirect('Inicio#Reservacion')//Si por alguna razon no hay un precio total para enviar a mercado pago
        ->with('message', trans('posadapraiso/alertas.reservacionesnodisponibles'));

    $arrayItemToPay=unserialize($request['arrayItemToPay']);
    $num_hab=$arrayItemToPay["habitacion"];
    $arrayIdPricesHab=$request['precios'];
    
     $arrayItemToPay;
     $arrayIdPricesHab;


      $price=$request['total'];
      $price=(float)$price;
     
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

      Session::put('nombre', $arrayItemToPay['nombre']);
      Session::put('llegada', $arrayItemToPay['llegada']);//Respaldo mis datos antes de enviar a la pagina depaypal(para no perderlos)
      Session::put('salida', $arrayItemToPay['salida']);
      Session::put('habitacion', $arrayItemToPay['habitacion']);
      Session::put('adultos', $arrayItemToPay['adultos']);
      Session::put('menores',$arrayItemToPay['menores']);
      Session::put('promo', $arrayItemToPay['promo']);
      Session::put('name', $name);
      Session::put('quantity', $quantity);
      Session::put('price', $price);
      Session::put('arrayIdPricesHab', $arrayIdPricesHab);
      
      /*____________Empiezo a usar la clase de Mercado de pago_________________________________*/   
  
      $mp= new MP($this->CLIENT_ID,$this->CLIENT_SECRET);
      $preference_data = array (
        "back_urls"=>  array("success"=>"http://hotelposadaparaiso.com.mx/mp_succes","failure"=>"http://hotelposadaparaiso.com.mx/mp_filed","pending"=>"http://hotelposadaparaiso.com.mx/mp_pending"),
        "auto_return"=> "all",
        "items" => array(
            array (
          	"id"=>"12345678",
            "title" => "Su reservación en el Hotel posada paraíso",
            "picture_url"=>"http://hotelposadaparaiso.com.mx/img-posadaparaiso/paraisonaranja-22.png",
            "quantity" => 1,
            "currency_id" => "MX",
            "unit_price" =>  (float)$price
            ) 
        ),
        
        "payment_methods" => array( /*aqui excluyo tipos de pago rapipago, transf bancaria, atm*/ 
            "excluded_payment_types" => array( 
                //array("id"=>"digital_currency"),  
                array( "id"=>"ticket"), 
                array("id"=>"bank_transfer"), 
                array("id"=>"atm"),	
                
             ),
            "excluded_payment_methods" => array( 
              array ( "id" => "oxxo")
            ),
          "installments" => 1
         ),
        
        "installments" => 1
        //,"notification_url" => "http://hotelposadaparaiso.com.mx/notification"
      );
     
      $preference = $mp->create_preference($preference_data);

      $access_token = $mp->get_access_token();
      //print_r ($access_token);
      //print_r ($preference);
      return redirect()->to($preference['response']['init_point']);
    }

    public function paymentSucces(){
     $this->saveOrder();
     return redirect('Inicio/#Reservacion')
            ->with('message', trans('posadapraiso/alertas.reservacionrealizadocorrectamente'));
    }

    public function paymentFailed(){
           Session::forget('nombre'); 
           Session::forget('llegada');
           Session::forget('salida');
           Session::forget('habitacion');
           Session::forget('adultos');
           Session::forget('menores');
           Session::forget('promo');
           Session::forget('arrayIdPricesHab');
     return redirect('Inicio/#Reservacion')
            ->with('message',  trans('posadapraiso/alertas.nosepudoreaizarreservaion') );
    }
  
  
    public function NotificationPayment(Request $request){

    $mp = new MP($this->CLIENT_ID,$this->CLIENT_SECRET);
      	
        // Get the payment and the corresponding merchant_order reported by the IPN.
        if($_GET["topic"] == 'payment'){
          $payment_info = $mp->get("/collections/notifications/" . $_GET["id"]);
          $merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["collection"]["merchant_order_id"]);
          // Get the merchant_order reported by the IPN.
          //$this->saveOrder();
                       
        } else if($_GET["topic"] == 'merchant_order'){
          $merchant_order_info = $mp->get("/merchant_orders/" . $_GET["id"]);
           $this->saveOrder();
        }

        if ($merchant_order_info["status"] == 200) {
          // If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items 
          $paid_amount = 0;

          foreach ($merchant_order_info["response"]["payments"] as  $payment) {
            if ($payment['status'] == 'approved'){
              $paid_amount += $payment['transaction_amount'];
            } 
          }
  
          if($paid_amount >= $merchant_order_info["response"]["total_amount"]){
            if(count($merchant_order_info["response"]["shipments"]) > 0) { // The merchant_order has shipments
              if($merchant_order_info["response"]["shipments"][0]["status"] == "ready_to_ship"){
                print_r("Totally paid. Print the label and release your item.");
              }
            } else { // The merchant_order don't has any shipments
              print_r("Totally paid. Release your item.");
            }
          } else {
            print_r("Not paid yet. Do not release your item.");
          }
        }
       
    }


       protected function saveOrder()
        {
            pp_reservation::create([
            'name'=>Session::get('nombre'),
            'arrival'=>Session::get('llegada'),
            'departure'=>Session::get('salida'),
            'room'=>Session::get('habitacion'),
            'grownups'=>Session::get('adultos'),
            'minors'=>Session::get('menores'),
            'promotions'=>"promo",
            'amount'=>Session::get('price'),
            ]);
             
            $id_last_inserted = (DB::table('pp_reservation')->max('id'));   

            $arrayPricesId=Session::get('arrayIdPricesHab');
            for($i=0;$i<Session::get('habitacion');$i++){
                 pp_reservation_details::create([
                'id_price'=>$arrayPricesId[$i],
                'id_reservation'=>$id_last_inserted,
                ]);
            }
		
           Session::forget('nombre'); 
           Session::forget('llegada');
           Session::forget('salida');
           Session::forget('habitacion');
           Session::forget('adultos');
           Session::forget('menores');
           Session::forget('promo');
           Session::forget('arrayIdPricesHab');

        }


}

