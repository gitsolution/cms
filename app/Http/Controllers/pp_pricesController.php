<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use Auth;
use Gate;

class pp_pricesController extends Controller
{
    public $fechaActaul;
    public function __construct()
    {
         $this->middleware('auth');
         $this->fechaActaul=date('Y-m-d');
         
         //$this->fechaActaul="2016-05-10";
         /*$this->fechaAnterior="2016-04-10";
        $this->fechaAnterior=;

         $date=new Carbon();
         $date=$date->format('Y-m-d');

         if($date > $this->fechaAnterior)
            echo "<script>alert('".$date."')</script>";
         else
            echo "<script>alert('".$this->fechaAnterior."')</script>";*/
    }  
    
  public function index()
  {
         if(Gate::denies('Reservaciones.ModulodeReservaciones'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Reservaciones.modulodePrecios'))
    {
      Auth::logout();
      return Redirect('login');
    }
         $flag='1'; 

         $prices =  DB::table('pp_prices')/*Obtengo la lista de precios */
         ->where('active','=', $flag)//exepto las eliminadas
         ->orderBy('id','DESC')->paginate(20);

         return view('prices/index',['prices'=>$prices,'fechaActaul'=>$this->fechaActaul]);
  }
   
  public function getPricesActive(){/*Obtiene los precios que estan activos*/
    
      $flag='1'; 

     $activePrice=null;
          $activePrice=DB::table('pp_prices')
         ->where('active','=', $flag)
         ->where('date_start','<=',$this->fechaActaul)
         ->where('date_end','>=',$this->fechaActaul)
         ->where('active_price','=',1)
         ->distinct('type_room')
         //->orderBy('id','DESC')
         ->get();
         if($activePrice!=null) 
           {
            $activePrice; 
           }
          else {
            $activePrice="";
          }
  
     return $activePrice; 

  }
  
  public function create(){
    if(Gate::denies('Reservaciones.ModulodeReservaciones'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Reservaciones.modulodePrecios'))
    {
      Auth::logout();
      return Redirect('login');
    }
    return view('prices/pricesform',['fechaActaul'=>$this->fechaActaul]);
  }


  public function store(Request $request){
    if(Gate::denies('Reservaciones.ModulodeReservaciones'))
    {
      Auth::logout();
      return Redirect('login');
    }
         
    if(Gate::denies('Reservaciones.modulodePrecios'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Reservaciones.PreciosCrear'))
    {
      Auth::logout();
      return Redirect('login');
    }

        $active='1';
        $ChekPubli='0';
        if($request ['ChekPublicar']== 'on')
        {
        	//if($this->aprovNewPriceActive()==true)
            //   { 
                $ChekPubli='1';
               // Session::flash('message','Registro Guardado Correctamente');    
            //   }
            // else {
            // 	Session::flash('message','Registro Guardado,Pero no se puede establecer como precio actual');    
            // }

        }
        else{
        	 //Session::flash('message','Registro Guardado Correctamente'); 
        }
      
      if($request['date_start']>=$this->fechaActaul)
      { \App\pp_prices::create([
      'title'=>$request['title'],
      'type_room'=>$request['type_room'],
      'price'=>$request['price'],
      'iva'=>$request['iva'],
      'date_start'=>$request['date_start'],
      'date_end'=>$request['date_end'],
      'active'=>$active,
      'active_price'=>$ChekPubli,
      ]);
      Session::flash('message','Registro Guardado Correctamente'); 
      }
      else
        Session::flash('message','Error.No se ha podido guardar porque la Fecha de inicio ya ha pasado.'); 

      return redirect('/admin/prices');

  }

  public function edit($id){
     if(Gate::denies('Reservaciones.ModulodeReservaciones'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Reservaciones.modulodePrecios'))
    {
      Auth::logout();
      return Redirect('login');
    }

      $language = \App\cms_prices::find($id);
      return view('prices/pricesform')->with('price',$price);
      }

  public function update($id,Request $request){
    if(Gate::denies('Reservaciones.ModulodeReservaciones'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Reservaciones.modulodePrecios'))
    {
      Auth::logout();
      return Redirect('login');
    }

    $menu = \App\pp_prices::find($id);
    $menu->fill($request->all());   
    $menu->save();   
    return redirect('/admin/prices')->with('message','Precio Actualizado Correctamente');
  }

  public function destroy($id){
    if(Gate::denies('Reservaciones.ModulodeReservaciones'))
    {
      Auth::logout();
      return Redirect('login');
    }
    
    if(Gate::denies('Reservaciones.modulodePrecios'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Reservaciones.PreciosEliminar'))
    {
      Auth::logout();
      return Redirect('login');
    }

    $language = \App\pp_prices::find($id);
    $language->active=0;
    $language->save(); 
    return redirect('/admin/prices')->with('message','Precio Eliminado');
  }
   

    public function publish($id){
      if(Gate::denies('Reservaciones.ModulodeReservaciones'))
      {
        Auth::logout();
        return Redirect('login');
      }
         
      if(Gate::denies('Reservaciones.modulodePrecios'))
      {
        Auth::logout();
        return Redirect('login');
      }

      if(Gate::denies('Reservaciones.PreciosActivar'))
      {
        Auth::logout();
        return Redirect('login');
      }

       $price = \App\pp_prices::find($id);
      
       if($price->date_end >= $this->fechaActaul){
          $price->active_price=1;//Se cambia a publicado para que lo tome en cuenta el metodo getObjectPriceActive().
          $price->save();   
          Session::flash('message','Publicado correctamente, el sistema lo activará en las fechas indicadas.');
       }
       else
          Session::flash('message','No se puede publicar por que la fecha de Finalizacion ya ha pasado.');

       
       return redirect('/admin/prices');      
    }

    public function checkPriceHasChildInReservation($id_price){//solo para actualizar

      if(Gate::denies('Reservaciones.ModulodeReservaciones'))
      {
        Auth::logout();
        return Redirect('login');
      }
      
      if(Gate::denies('Reservaciones.modulodePrecios'))
      {
        Auth::logout();
        return Redirect('login');
      }

       $num_rows=DB::table('pp_reservation')->where('id_price','=',$id_price)->count();
       if($num_rows>0)
         return  true;
       else
        return false;
    }

    public function aprovNewPriceActive($dateStart,$dateEnd){
      if(Gate::denies('Reservaciones.ModulodeReservaciones'))
      {
        Auth::logout();
        return Redirect('login');
      }
      
      if(Gate::denies('Reservaciones.modulodePrecios'))
      {
        Auth::logout();
        return Redirect('login');
      }

         //valida que todavia no haya llegado la fecha de finalizcion
        if($dateEnd >= $this->fechaActaul)
           {
            //aprobar que no haya una fecha mayor
           $objPriceActive= $this->getObjectPriceActive();
           if($objPriceActive!=null);
               {
                if($objPriceActive->date_end > $dateStart)
                  {
                  Session::flash('message','Esta fecha no ha llegado aún.El sistema la activara automaticamente.');
                  }
                else
                   {return false; }
               }
           }

        else
           { 
           Session::flash('message','la fecha de finalización ya ha pasado.'); 
           return false;
           }
  
         return true;
  }
}
