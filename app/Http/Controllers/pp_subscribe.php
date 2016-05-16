<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Redirect;
use Auth;
use Gate;

class pp_subscribe extends Controller
{

public function __construct()
    {
        $this->middleware('auth');
    }  
    
  public function index()
   {
      if(Gate::denies('Suscripciones.ModulodeSuscripciones'))
      {
        Auth::logout();
        return Redirect('login');
      }
        
         $flag='1'; 
         $suscription =  DB::table('pp_subscribe')->where('active','=', $flag)->orderBy('id','ASC')->paginate(20);
         return view('posadaparaiso/suscription/index',['suscriptions'=>$suscription ]);
   }

  /*public function create(){
    return view('posadaparaiso/suscription/suscriptionform');
  }*/

  public function store(Request $request){
    if(Gate::denies('Suscripciones.ModulodeSuscripciones'))
    {
        Auth::logout();
        return Redirect('login');
    }
       $active='1'; 
       \App\pp_subscribe::create([
      'name'=>$request['name'],
      'surnames'=>$request['surnames'],
      'email'=>$request['email'],
      'active'=>$active,
      'status'=>"",
      ]);
      Session::flash('messageSubscription','Sucripción realizada Correctamente');    

      return redirect('/Inicio#Suscripcion');
      //return redirect('/admin/suscription');

  }

  public function edit($id){
    if(Gate::denies('Suscripciones.ModulodeSuscripciones'))
    {
        Auth::logout();
        return Redirect('login');
    }

    if(Gate::denies('Suscripciones.SuscriptoresEditar'))
    {
      Auth::logout();
      return Redirect('login');
    }
      $suscription = \App\pp_subscribe::find($id);
      return view('posadaparaiso/suscription/suscriptionform')->with('suscription',$suscription);
      }

  public function update($id,Request $request){
    if(Gate::denies('Suscripciones.ModulodeSuscripciones'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Suscripciones.SuscriptoresEditar'))
    {
      Auth::logout();
      return Redirect('login');
    }

    $suscription = \App\pp_subscribe::find($id);
    $suscription->fill($request->all());   
    $suscription->save();   
    return redirect('/admin/suscription')->with('message','Suscripción Actualizado Correctamente');
  }

  public function destroy($id){
    if(Gate::denies('Suscripciones.ModulodeSuscripciones'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Suscripciones.SuscriptoresEliminar'))
    {
      Auth::logout();
      return Redirect('login');
    }
    $suscription = \App\pp_subscribe::find($id);
    $suscription->active=0;
    $suscription->save(); 
    return redirect('/admin/suscription')->with('message','Suscripción Eliminada');
  }
    
}
