<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\cotizacionrequest;
use App\Http\Controllers\Controller;
use Mail;

class cotizacioncontroller extends Controller
{
    public function store(cotizacionrequest $request)
    {
    	$data['name']=$request['name'];
        $data['email']=$request['email'];
        $data['phone']=$request['phone'];
        $data['montoaproximado']=$request['montoaproximado'];
        $data['ventasmensuales']=$request['ventasmensuales'];
        $data['oficioprofesion']=$request['oficioprofesion'];
        $data['destinocredito']=$request['destinocredito'];
        $data['asunt']=$request['asunt'];

        Mail::send('mails.frmcotizacion', ['data' => $data], function($mail)
        use($data){
            $mail->subject('Cotización');
            $mail->to('analista_de_credito@hotmail.com')->bcc('romanalbores@gmail.com');
        });

        return view('frontend.page');

    }
}
