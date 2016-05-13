<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;

class pp_subscribe extends Controller
{

public function __construct()
    {
        $this->middleware('auth');
    }  
    
  public function index()
   {
        
         $flag='1'; 
         $suscription =  DB::table('pp_subscribe')->where('active','=', $flag)->orderBy('id','ASC')->paginate(20);
         return view('posadaparaiso/suscription/index',['suscriptions'=>$suscription ]);
   }

  /*public function create(){
    return view('posadaparaiso/suscription/suscriptionform');
  }*/

  public function store(Request $request){
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
      $suscription = \App\pp_subscribe::find($id);
      return view('posadaparaiso/suscription/suscriptionform')->with('suscription',$suscription);
      }

  public function update($id,Request $request){
    $suscription = \App\pp_subscribe::find($id);
    $suscription->fill($request->all());   
    $suscription->save();   
    return redirect('/admin/suscription')->with('message','Suscripción Actualizado Correctamente');
  }

  public function destroy($id){
    $suscription = \App\pp_subscribe::find($id);
    $suscription->active=0;
    $suscription->save(); 
    return redirect('/admin/suscription')->with('message','Suscripción Eliminada');
  }
    
}
