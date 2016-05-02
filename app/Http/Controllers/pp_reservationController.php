<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;

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
    
    public function store(Request $request){
     \App\reservacion::create([
      'llegada'=>$request['llegada'],
      'salida'=>$request['salida'],
      'habitacion'=>$request['habitacion'],
      'adultos'=>$request['adultos'],
      'menores'=>$request['menores'],
      'promo'=>$request['promo'],
      ]);
      //Session::flash('message','Reservación Guardada Correctamente');    
      return redirect('/Inicio');

    } 

}
