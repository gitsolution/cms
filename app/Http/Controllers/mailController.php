<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class mailController extends Controller
{
    public function store(Request $request)
    {
    	Mail:send('email.contact',$request->all(),function($msj){
    		$msj->subject('correo de contacto');
    		$msj->to('iver.fabi13@gmail.com');
    		Session::flash('mensaje','mesaje enviado correctamente');
    		return Redirect::to('/login');
    	});
    }

}
