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
//use Illuminate\Support\Facades\Input;


class PaypalController extends Controller
{
   private $_api_context;
 
	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');//utiliza los datos del archivo de configuración
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}
 
public function postPayment(Request $request)//Metodo para enviar a Paypal
{       

      $priceController = new  pp_pricesController();
      $price=$priceController->getPriceActive();
      if($price==0 || $price==null)/*Si no ha establecido un precio en el panel de administración*/
         {return redirect('Inicio')
            ->with('message', 'No disponible en estos momentos.');
         }
      $id_price=$priceController->getIdPriceActive();
    
      $name_client=$request['name'];
      $llegada=$request['llegada'];
      $salida=$request['salida'];
      $habitacion=$request['habitacion'];
      $adultos=$request['adultos'];
      $menores=$request['menores'];
      $promo=$request['promo'];
     
     
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
        
      Session::put('nombre', $request['nombre']);
      Session::put('llegada', $request['llegada']);//Respaldo mis datos antes de enviar a la pagina depaypal(para no perderlos)
      Session::put('salida', $request['salida']);
      Session::put('habitacion', $request['habitacion']);
      Session::put('adultos', $request['adultos']);
      Session::put('menores', $request['menores']);
      Session::put('promo', $request['promo']);
      Session::put('name', $name);
      Session::put('quantity', $quantity);
      Session::put('price', $price);
      Session::put('id_price', $id_price);

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
				->with('message', 'Hubo un problema al intentar pagar con Paypal');
		}
    
		$payment = Payment::get($payment_id, $this->_api_context);
 
		$execution = new PaymentExecution();
		$execution->setPayerId(\Illuminate\Support\Facades\Input::get('PayerID'));
 
		$result = $payment->execute($execution, $this->_api_context);/*Al lanzar este metodo es cuando se realiza la transaccion completa*/
 
		if ($result->getState() == 'approved') {/*Si la compra se realizo*/
			      
            $this->saveOrder();
            //Aqui guardamos en la base de datos la compra realizada
           
			return redirect('Inicio')
				->with('message', 'Compra realizada de forma correcta');
		}
		return redirect('Inicio')
			->with('message', 'La compra fue cancelada');
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
      'promotions'=>Session::get('promo'),
      'id_price'=>Session::get('id_price'),
      ]);
      

     Session::forget('nombre'); 
     Session::forget('llegada');
     Session::forget('salida');
     Session::forget('habitacion');
     Session::forget('adultos');
     Session::forget('menores');
     Session::forget('promo');
     Session::forget('id_price');
    
    return redirect('/Inicio');

 

	}

}
