<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
 
use App\Order;
use App\OrderItem;

use URL;
use Session;
use DB;
use Redirect;
use Input;
use App\pp_reservation;
use App\pp_reservation_details;
use App;
//use Illuminate\Support\Facades\Input;


class PaypalController extends Controller
{
   private $_api_context;
 
	public function __construct()
	{
     //para los idiomas
     if(session('lang')!=null)
          App::setLocale(session('lang'));/*Asigno el idioma a laravel para este controlador*/
        else
          App::setLocale('es');
       $language=App::getLocale();/*Obtengo el idioma definido en laravel*/
       $this->id_language=DB::table('cms_language')->where('code','=', $language)->max('id'); 


		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');//utiliza los datos del archivo de configuración
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}
 
public function postPayment(Request $request)//Metodo para enviar a Paypal
{    
    if($request['total']==0 || $request['total']==null )
        return redirect('Inicio')//Si por alguna razon no hay un precio total para enviar a paypal 
        ->with('message', trans('posadapraiso/alertas.reservacionesnodisponibles') );

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
      $apellidos=$arrayItemToPay['apellidos']; 
      $noches=$arrayItemToPay['noches'];     
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

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
 
        $items = array();
        $subtotal = 0;
        $currency = 'MXN';
 
            $item = new Item();
            $item->setName($name)
            ->setCurrency($currency)
            ->setDescription($extract)
            ->setQuantity($quantity)
            ->setPrice($price);
            $items[] = $item;
            $subtotal += $quantity * $price;

        $item_list = new ItemList();
        $item_list->setItems($items);
 
        $details = new Details();
        $details->setSubtotal($subtotal)
        ->setShipping($costoDeEnvio);/*Costo por envio*/

        $total = $subtotal + $costoDeEnvio;

       $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total)
            ->setDetails($details);
 
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Pedido de reservación');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(\URL::route('payment.status'))//redirige cuando se acepta el pago
            ->setCancelUrl(\URL::route('payment.status'));//redirige cuando se cancela el pago
 
        $payment = new Payment();
        $payment->setIntent('Sale')//tipo de pago venta directa
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        
      Session::put('nombre', $arrayItemToPay['nombre']);
      Session::put('apellidos', $arrayItemToPay['apellidos']);
      Session::put('noches', $arrayItemToPay['noches']);
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


        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {/*valida nuestro objeto para paypal*/
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Ups! Algo salió mal');
            }
        }

        /*Si todo salio bien paypal devuelve informacion*/
        
        //dentro de la info devuelve un enlace adonde redirige al ususario
       foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {/*Si esta bien aprueba el Url*/
                $redirect_url = $link->getHref();
                break;
            }
        }

        //devuelve un id
        // add payment ID to session
        \Session::put('paypal_payment_id', $payment->getId());
 
        if(isset($redirect_url)) {
            // redirect to paypal
            return \Redirect::away($redirect_url);/*redirige a una Url externa (Paypal)*/
        }
 
        return redirect('Inicio')
            ->with('message', 'Ups! Error desconocido.');

}



 
	public function getPaymentStatus()/*Respuest que da paypal una vez que el usuario inicio secion*/
	{/*Nos regresa datos por la uri*/
		// Get the payment ID before session clear
		$payment_id = \Session::get('paypal_payment_id');
 
		// clear the session payment ID
		\Session::forget('paypal_payment_id');
 
		$payerId = \Illuminate\Support\Facades\Input::get('PayerID');
		$token = \Illuminate\Support\Facades\Input::get('token');
 
		if (empty($payerId) || empty($token)) {
			return redirect('Inicio')//Si hubo un problema redirigo al usuario 
				->with('message',trans('posadapraiso/alertas.problemaalpagarconpaypal'));
		}
    
		$payment = Payment::get($payment_id, $this->_api_context);
 
		$execution = new PaymentExecution();
		$execution->setPayerId(\Illuminate\Support\Facades\Input::get('PayerID'));
 
		$result = $payment->execute($execution, $this->_api_context);/*Al lanzar este metodo es cuando se realiza la transaccion completa*/
 
		if ($result->getState() == 'approved') {/*Si la compra se realizo*/
			      
            $this->saveOrder();//Aqui guardamos en la base de datos la compra realizada
            
           
			return redirect('Inicio#Reservacion')
				->with('message', trans('posadapraiso/alertas.reservacioncorrecta'));
		}
		return redirect('Inicio')
			->with('message',  trans('posadapraiso/alertas.comprafuecancelada'));
	}
 
	protected function saveOrder()
	{
      pp_reservation::create([
      'name'=>Session::get('nombre'),
      'surnames'=>Session::get('apellidos'),
      'nights'=>Session::get('noches'),
      'arrival'=>Session::get('llegada'),
      'departure'=>Session::get('salida'),
      'room'=>Session::get('habitacion'),
      'grownups'=>Session::get('adultos'),
      'minors'=>Session::get('menores'),
      'promotions'=>Session::get('promo'),
      'amount'=>Session::get('price'),
      //'id_price'=>Session::get('id_price'),
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
     Session::forget('noches');
     Session::forget('apellidos'); 
     Session::forget('llegada');
     Session::forget('salida');
     Session::forget('habitacion');
     Session::forget('adultos');
     Session::forget('menores');
     Session::forget('promo');
     Session::forget('arrayIdPricesHab');
    
     return redirect('/Inicio');

	}

}
